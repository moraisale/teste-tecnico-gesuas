<?php
namespace Alexandre\Gesuas\Model;


class CitizenRepository {
    public function __construct(private \PDO $pdo) {}

    public function save(Citizen $citizen): void {
        $stmt = $this->pdo->prepare(
            "INSERT INTO citizens (name, nis) VALUES (:name, :nis)"
        );
        
        $stmt->execute([
            ':name' => $citizen->name,
            ':nis' => $citizen->nis
        ]);
        
        $citizen->id = (int) $this->pdo->lastInsertId();
    }

    public function findByNis(string $nis): ?Citizen {
        $stmt = $this->pdo->prepare("SELECT * FROM citizens WHERE nis = :nis");
        $stmt->bindParam(':nis', $nis, \PDO::PARAM_STR);
        $stmt->execute();
        
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $data ? new Citizen($data['id'], $data['name'], $data['nis']) : null;
    }
}