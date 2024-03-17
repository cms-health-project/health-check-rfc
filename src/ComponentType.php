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

/**
 * Provides valid CMS HealthCheck component types.
 */
enum ComponentType: string
{
    case System = 'system';
    case Component = 'component';
    case DataStorage = 'datastorage';
}
