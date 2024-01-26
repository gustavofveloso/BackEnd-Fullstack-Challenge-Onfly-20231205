<?php

namespace Core\UseCase\Expense;

use Core\Domain\Entity\Expense;
use Core\Domain\Repository\ExpenseRepositoryInterface;
use Core\UseCase\DTO\Expense\{
    ExpenseCreateInputDto,
    ExpenseCreateOutputDto
};

class CreateExpenseUseCase
{
    protected $repository;

    public function __construct(ExpenseRepositoryInterface $repository)
    {
        $this->repository = $repository;    
    }

    public function execute(ExpenseCreateInputDto $input): ExpenseCreateOutputDto
    {
        $expense = new Expense(
            id: 1,
            user_id: 1,
            description: 'Passagem de avião para o Chile',
            date: '2024-01-15',
            value: 299.99
        );

       $newExpense = $this->repository->insert($expense);

       return new ExpenseCreateOutputDto(
            user_id: $newExpense->user_id,
            description: $newExpense->description,
            date: $newExpense->date,
            value: $newExpense->value
       );
    }
}