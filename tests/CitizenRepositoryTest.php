<?php
namespace Alexandre\Gesuas\Tests;

use PHPUnit\Framework\TestCase;
use Alexandre\Gesuas\Model\Citizen;
use Alexandre\Gesuas\Model\CitizenRepository;
use Alexandre\Gesuas\Database;

class CitizenRepositoryTest extends TestCase
{
    private \PDO $pdo;
    private CitizenRepository $repository;

    protected function setUp(): void
    {
        // Configura banco de dados em memória para testes
        $this->pdo = new \PDO('sqlite::memory:');
        $this->pdo->exec('CREATE TABLE citizens (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            nis TEXT NOT NULL UNIQUE
        )');
        
        $this->repository = new CitizenRepository($this->pdo);
    }

    public function testSaveAndFindCitizen()
    {
        $citizen = new Citizen(null, 'Pessoa Teste', '12345678901');
        $this->repository->save($citizen);
        
        $found = $this->repository->findByNis('12345678901');
        
        $this->assertNotNull($found);
        $this->assertEquals('Pessoa Teste', $found->name);
    }

    public function testDuplicateNisThrowsException()
    {
        $this->expectException(\PDOException::class);
        
        $citizen1 = new Citizen(null, 'Pessoa Teste Um ', '11111111111');
        $citizen2 = new Citizen(null, 'Pessoa Teste Dois', '11111111111');
        
        $this->repository->save($citizen1);
        $this->repository->save($citizen2);
    }

}