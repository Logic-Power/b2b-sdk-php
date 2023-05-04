<?php

declare(strict_types=1);

namespace LogicPower\Translation;

use LogicPower\Exception\LogicPowerException;
use LogicPower\Translation\Enum\Locale;

class Translator
{
    /**
     * Получение локализированного значения.
     *
     * @return string|int|float|null
     *
     * @throws LogicPowerException
     *
     * @see Locale
     */
    public static function translate(array $values, ?string $locale)
    {
        if (null === $locale) {
            $locale = Locale::UK;
        }

        if (!in_array($locale, Locale::getAll(), true)) {
            throw new LogicPowerException(sprintf('Неподдерживаемая локаль [%s]', $locale));
        }

        return $values[$locale];
    }
}
