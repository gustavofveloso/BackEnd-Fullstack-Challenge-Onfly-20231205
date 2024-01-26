<?php

namespace Tests\Unit\UseCase\Expense;

use Core\Domain\Entity\Expense;
use Core\Domain\Repository\ExpenseRepositoryInterface;
use Core\UseCase\DTO\Expense\ExpenseCreateInputDto;
use Core\UseCase\DTO\Expense\ExpenseCreateOutputDto;
use Core\UseCase\DTO\Expense\ExpenseInputDto;
use Core\UseCase\DTO\Expense\ExpenseOutputDto;
use Core\UseCase\Expense\ListExpenseUseCase;
use Mockery;
use stdClass;
use Tests\TestCase;

class ListExpenseUseCaseUnitTest extends TestCase
{
    private $mockRepo;
    private $mockEntity;
    private $mockInputDto;
    private $spy;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testGetById()
    {
        $id = 1;
        $user_id = 1;
        $description = 'Passagem de avião para o Chile';
        $date = '2024-01-15';
        $value = 299.99;

        $this->mockEntity = Mockery::mock(Expense::class,[
            $id,
            $user_id,
            $description,
            $date,
            $value
        ]);

        $this->mockRepo = Mockery::mock(stdClass::class, ExpenseRepositoryInterface::class);
        $this->mockRepo->shouldReceive('findById')
                        ->with($id)
                        ->andReturn($this->mockEntity);

        $this->mockInputDto = Mockery::mock(ExpenseInputDto::class, [
            $id
        ]);

        $useCase = new ListExpenseUseCase($this->mockRepo);
        $response = $useCase->execute($this->mockInputDto);

        $this->assertInstanceOf(ExpenseOutputDto::class, $response);
        $this->assertEquals('Passagem de avião para o Chile', $response->description);
        $this->assertEquals($id, $response->id);

        /**
         * Spies
         */

        $this->spy = Mockery::spy(stdClass::class, ExpenseRepositoryInterface::class);
        $this->spy->shouldReceive('findById')
                        ->with($id)
                        ->andReturn($this->mockEntity);

        $useCase = new ListExpenseUseCase($this->spy);
        $response = $useCase->execute($this->mockInputDto);
        $this->spy->shouldHaveReceived('findById');

    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}