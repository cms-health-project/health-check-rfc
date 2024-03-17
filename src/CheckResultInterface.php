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
    public function getComponentId(): string;
    public function getComponentType(): ComponentType;
    public function getStatus(): CheckResultStatus;
    public function getObservedValue(): string;
    /**
     * @return string|null Returns NULL if not use-full for the observed value, otherwise the value unit.
     */
    public function getObservedUnit(): string|null;
    public function getOutput(): string;
    public function getTime(): \DateTime;
}
