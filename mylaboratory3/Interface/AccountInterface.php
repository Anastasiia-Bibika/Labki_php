<?php
namespace Interface;

interface AccountInterface
{
    public function setCode(int $code): AccountInterface;

    public function getCode(): int;

    public function setFullname(string $fullname): AccountInterface;

    public function getFullname(): string;

    public function setState(string $state): AccountInterface;

    public function getState(): string;

    public function setSalary(int $salary): AccountInterface;

    public function getSalary(): int;

    public function setChildren(int $children): AccountInterface;

    public function getChildren(): int;

    public function setExperience(string $experience): AccountInterface;

    public function getExperience(): string;
}