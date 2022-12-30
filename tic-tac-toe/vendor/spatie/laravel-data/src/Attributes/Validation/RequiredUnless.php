<?php

namespace Spatie\LaravelData\Attributes\Validation;

use Attribute;
use BackedEnum;
use Illuminate\Support\Arr;
use Spatie\LaravelData\Support\Validation\RequiringRule;

#[Attribute(Attribute::TARGET_PROPERTY)]
class RequiredUnless extends StringValidationAttribute implements RequiringRule
{
    protected string|array $values;

    public function __construct(
        protected string $field,
        array | string | BackedEnum ...$values
    ) {
        $this->values = Arr::flatten($values);
    }

    public static function keyword(): string
    {
        return 'required_unless';
    }

    public function parameters(): array
    {
        return [
            $this->field,
            $this->normalizeValue($this->values),
        ];
    }
}
