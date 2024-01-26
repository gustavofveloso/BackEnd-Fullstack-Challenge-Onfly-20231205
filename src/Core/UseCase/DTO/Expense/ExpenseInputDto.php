<?php

namespace Core\UseCase\DTO\Expense;

class ExpenseInputDto
{
    public function __construct(
        public int $id,
    ) {}
}