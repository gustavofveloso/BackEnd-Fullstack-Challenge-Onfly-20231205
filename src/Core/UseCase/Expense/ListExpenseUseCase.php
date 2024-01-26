<?php

namespace Core\UseCase\Expense;

use Core\Domain\Entity\Expense;
use Core\Domain\Repository\ExpenseRepositoryInterface;
use Core\UseCase\DTO\Expense\{
    ExpenseInputDto,
    ExpenseOutputDto
};

class ListExpenseUseCase
{
    protected $repository;

    public function __construct(ExpenseRepositoryInterface $repository)
    {
        $this->repository = $repository;    
    }

    public function execute(ExpenseInputDto $input): ExpenseOutputDto
    {
        $expense = $this->repository->findById($input->id);

        return new ExpenseOutputDto(
            id: $expense->id,
            user_id: $expense->user_id,
            description: $expense->description,
            date: $expense->date,
            value: $expense->value
        );
    }
}