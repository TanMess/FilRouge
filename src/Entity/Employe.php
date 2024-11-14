<?php

namespace App\Entity;

use App\Repository\EmployeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeRepository::class)]
class Employe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $mail_emp = null;

    #[ORM\Column(length: 50)]
    private ?string $role_emp = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMailEmp(): ?string
    {
        return $this->mail_emp;
    }

    public function setMailEmp(string $mail_emp): static
    {
        $this->mail_emp = $mail_emp;

        return $this;
    }

    public function getRoleEmp(): ?string
    {
        return $this->role_emp;
    }

    public function setRoleEmp(string $role_emp): static
    {
        $this->role_emp = $role_emp;

        return $this;
    }
}
