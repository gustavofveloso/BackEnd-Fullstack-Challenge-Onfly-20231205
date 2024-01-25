<?php

namespace Core\UseCase\DTO\Expense;

class ExpenseCreateOutputDto
{
    public function __construct(
        public int $user_id,
        public string $description,   
        public string $date,   
        public float $value   
    ) {}
}