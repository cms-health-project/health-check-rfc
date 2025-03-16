<?php

declare(strict_types=1);

/*
 * This file is part of the CMS Health Project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the MIT License.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace CmsHealth\Definition;

interface CheckResultInterface
{
    public function getStatus(): CheckResultStatus;
    public function getComponentId(): string|null;
    public function getComponentType(): string|null;
    /**
     * @return string|null Can return NULL for check only having a status or and maybe an output.
     */
    public function getObservedValue(): string|null;
    /**
     * @return string|null Returns NULL if not use-full for the observed value, otherwise the value unit.
     */
    public function getObservedUnit(): string|null;
    public function getOutput(): string|null;
    public function getTime(): \DateTimeInterface|null;
}
