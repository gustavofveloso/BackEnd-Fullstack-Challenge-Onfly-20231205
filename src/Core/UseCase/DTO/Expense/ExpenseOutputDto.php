<?php

namespace Core\UseCase\DTO\Expense;

class ExpenseOutputDto
{
    public function __construct(
        public int $id,
        public int $user_id,
        public string $description,   
        public string $date,   
        public float $value
    ) {}
}