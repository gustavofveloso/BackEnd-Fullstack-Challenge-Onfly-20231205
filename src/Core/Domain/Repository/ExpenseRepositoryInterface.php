<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\Expense;

interface ExpenseRepositoryInterface
{
    public function insert(Expense $expense): Expense;
    public function findById(int $id): Expense;
    public function findAll(string $filter = '', $order = 'DESC'): array;
    public function paginate(string $filter = '', $order = 'DESC', int $page = 1, int $totalPage = 15): array;
    public function update(Expense $expense): Expense;
    public function delete(int $id): bool;
    public function toExpense(object $data): Expense;
}