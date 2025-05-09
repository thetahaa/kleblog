<?php

declare(strict_types=1);

namespace Pest\PendingCalls;

use Closure;
use Pest\Exceptions\AfterBeforeTestFunction;
use Pest\PendingCalls\Concerns\Describable;
use Pest\Support\Arr;
use Pest\Support\Backtrace;
use Pest\Support\ChainableClosure;
use Pest\Support\HigherOrderMessageCollection;
use Pest\Support\NullClosure;
use Pest\TestSuite;

/**
 * @internal
 *
 * @mixin TestCall
 */
final class BeforeEachCall
{
    use Describable;

    /**
     * Holds the before each closure.
     */
    private readonly Closure $closure;

    /**
     * The test call proxies.
     */
    private readonly HigherOrderMessageCollection $testCallProxies;

    /**
     * The test case proxies.
     */
    private readonly HigherOrderMessageCollection $testCaseProxies;

    /**
     * Creates a new Pending Call.
     */
    public function __construct(
        public readonly TestSuite $testSuite,
        private readonly string $filename,
        ?Closure $closure = null
    ) {
        $this->closure = $closure instanceof Closure ? $closure : NullClosure::create();

        $this->testCallProxies = new HigherOrderMessageCollection;
        $this->testCaseProxies = new HigherOrderMessageCollection;

        $this->describing = DescribeCall::describing();
    }

    /**
     * Creates the Call.
     */
    public function __destruct()
    {
        $describing = $this->describing;
        $testCaseProxies = $this->testCaseProxies;

        $beforeEachTestCall = function (TestCall $testCall) use ($describing): void {

            if ($this->describing !== []) {
                if (Arr::last($describing) !== Arr::last($this->describing)) {
                    return;
                }

                if (! in_array(Arr::last($describing), $testCall->describing, true)) {
                    return;
                }
            }

            $this->testCallProxies->chain($testCall);
        };

        $beforeEachTestCase = ChainableClosure::boundWhen(
            fn (): bool => $describing === [] || in_array(Arr::last($describing), $this->__describing, true),
            ChainableClosure::bound(fn () => $testCaseProxies->chain($this), $this->closure)->bindTo($this, self::class),
        )->bindTo($this, self::class);

        assert($beforeEachTestCase instanceof Closure);

        $this->testSuite->beforeEach->set(
            $this->filename,
            $this,
            $beforeEachTestCall,
            $beforeEachTestCase,
        );
    }

    /**
     * Runs the given closure after the test.
     */
    public function after(Closure $closure): self
    {
        if ($this->describing === []) {
            throw new AfterBeforeTestFunction($this->filename);
        }

        return $this->__call('after', [$closure]);
    }

    /**
     * Saves the calls to be used on the target.
     *
     * @param  array<int, mixed>  $arguments
     */
    public function __call(string $name, array $arguments): self
    {
        if (method_exists(TestCall::class, $name)) {
            $this->testCallProxies
                ->add(Backtrace::file(), Backtrace::line(), $name, $arguments);

            return $this;
        }

        $this->testCaseProxies
            ->add(Backtrace::file(), Backtrace::line(), $name, $arguments);

        return $this;
    }
}
