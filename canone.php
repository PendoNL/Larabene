<?php
/**
 * Will pass if the logged in user has access to
 * one of the given permissions using Gate::allows.
 * Usage:.
 *
 *
 *  @canone('update-company','company-admin')
 *      <a href="{{ route('admin.companies.edit', [$company->id]) }}" class="btn btn-small btn-primary">Modify</a>
 *  @endif
 */
Blade::directive('canone', function ($expression) {
    $permissions = explode(',', str_replace(['(', ')', "'", ' '], '', $expression));
    foreach ($permissions as $key => $permission) {
        $permissions[$key] = "Gate::allows('{$permission}')";
    }

    return '<?php if('.implode(' || ', $permissions).'): ?>';
});
