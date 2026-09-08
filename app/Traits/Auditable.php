<?php

namespace App\Traits;

use App\Models\ActivityLog;

trait Auditable
{
    public function logActivity(
        string $action,
        ?array $oldValues = null,
        ?array $newValues = null
    ): void {
        ActivityLog::create([
            'action' => $action,
            'model_type' => static::class,
            'model_id' => $this->id,
            'old_values' => $oldValues,
            'new_values' => $newValues,
        ]);
    }
}