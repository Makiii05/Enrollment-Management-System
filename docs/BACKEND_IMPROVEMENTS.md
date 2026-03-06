# Backend Improvement Suggestions

This document outlines potential backend improvements for the Enrollment System that can enhance code maintainability, reduce redundancy, and improve overall code quality.

---

## 1. Model Accessors for Formatted Names

### Current Issue

Throughout the Blade templates, name concatenation is repeated manually:

```blade
<td>{{$applicant->first_name}} {{$applicant->last_name}}</td>
```

### Suggested Improvement

Add accessor methods to your Eloquent models to provide formatted name outputs.

#### In `app/Models/Applicant.php`:

```php
/**
 * Get the full name of the applicant.
 */
public function getFullNameAttribute(): string
{
    return trim("{$this->first_name} {$this->last_name}");
}

/**
 * Get the full name with middle name.
 */
public function getFullNameWithMiddleAttribute(): string
{
    $middle = $this->middle_name ? " {$this->middle_name} " : ' ';
    return trim("{$this->first_name}{$middle}{$this->last_name}");
}

/**
 * Get the formal name (Last, First M.).
 */
public function getFormalNameAttribute(): string
{
    $middleInitial = $this->middle_name ? strtoupper($this->middle_name[0]) . '.' : '';
    return "{$this->last_name}, {$this->first_name} {$middleInitial}";
}
```

#### Usage in Blade:

```blade
<td>{{ $applicant->full_name }}</td>
<td>{{ $applicant->formal_name }}</td>
```

#### Apply to:

- `Applicant` model
- `Student` model
- Any model with name fields

---

## 2. Create a Trait for Common Name Logic

### Suggested Improvement

Create a reusable trait for models that share name formatting logic.

#### Create `app/Traits/HasFullName.php`:

```php
<?php

namespace App\Traits;

trait HasFullName
{
    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    public function getFullNameWithMiddleAttribute(): string
    {
        $middle = $this->middle_name ? " {$this->middle_name} " : ' ';
        return trim("{$this->first_name}{$middle}{$this->last_name}");
    }

    public function getFormalNameAttribute(): string
    {
        $middleInitial = $this->middle_name
            ? strtoupper(substr($this->middle_name, 0, 1)) . '.'
            : '';
        return trim("{$this->last_name}, {$this->first_name} {$middleInitial}");
    }
}
```

#### Usage in Models:

```php
use App\Traits\HasFullName;

class Applicant extends Model
{
    use HasFullName;
    // ...
}

class Student extends Model
{
    use HasFullName;
    // ...
}
```

---

## 3. Add Address Formatting Accessor

### Current Issue

Address display requires multiple field concatenations.

### Suggested Improvement

```php
public function getFullPresentAddressAttribute(): string
{
    $parts = array_filter([
        $this->present_address,
        $this->zip_code ? "ZIP: {$this->zip_code}" : null,
    ]);
    return implode(', ', $parts);
}
```

---

## 4. Money/Income Formatting Accessor

### Current Issue

Income fields are displayed as raw integers.

### Suggested Improvement

```php
public function getFormattedMotherIncomeAttribute(): string
{
    if (!$this->mother_monthly_income) {
        return '-';
    }
    return '₱' . number_format($this->mother_monthly_income, 2);
}

// Generic helper method
public function formatCurrency(?int $amount): string
{
    if (!$amount) {
        return '-';
    }
    return '₱' . number_format($amount, 2);
}
```

---

## 5. Status Badge Helper

### Current Issue

Status badge styling is duplicated in JavaScript and Blade views.

### Suggested Improvement

Add a method to return status with appropriate CSS class:

```php
public function getStatusBadgeClassAttribute(): string
{
    return match($this->status) {
        'pending' => 'badge-warning',
        'approved', 'admitted' => 'badge-success',
        'rejected' => 'badge-error',
        'interview', 'exam', 'evaluation' => 'badge-info',
        default => 'badge-ghost',
    };
}
```

#### Usage in Blade:

```blade
<span class="badge {{ $applicant->status_badge_class }}">
    {{ ucfirst($applicant->status) }}
</span>
```

---

## 6. Scope Methods for Common Queries

### Suggested Improvement

Add query scopes to models for commonly used filters.

```php
// In Applicant.php
public function scopeForAcademicYear($query, string $year)
{
    return $query->where('academic_year', $year);
}

public function scopePending($query)
{
    return $query->where('status', 'pending');
}

public function scopeAdmitted($query)
{
    return $query->where('status', 'admitted');
}

public function scopeSearch($query, ?string $search)
{
    if (empty($search)) {
        return $query;
    }

    return $query->where(function ($q) use ($search) {
        $q->where('first_name', 'like', "%{$search}%")
          ->orWhere('last_name', 'like', "%{$search}%")
          ->orWhere('application_no', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%");
    });
}
```

#### Usage in Controller:

```php
$applicants = Applicant::with('admission')
    ->forAcademicYear($selectedYear)
    ->search($search)
    ->orderBy($sortColumn, $sortDirection)
    ->paginate(20);
```

---

## 7. Form Request Validation Classes

### Current Issue

Validation rules are duplicated in multiple controller methods.

### Suggested Improvement

Create dedicated Form Request classes.

#### Create `app/Http/Requests/UpdateApplicantRequest.php`:

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            // ... other rules
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required.',
            'email.email' => 'Please enter a valid email address.',
        ];
    }
}
```

---

## 8. Create a Service Class for Complex Operations

### Current Issue

Controller methods contain complex business logic (e.g., admission process handling).

### Suggested Improvement

Extract to dedicated service classes.

#### Create `app/Services/AdmissionService.php`:

```php
<?php

namespace App\Services;

use App\Models\Applicant;
use App\Models\Admission;

class AdmissionService
{
    public function markForInterview(array $applicantIds, int $scheduleId): array
    {
        $pendingApplicants = Applicant::whereIn('id', $applicantIds)
            ->where('status', 'pending')
            ->pluck('id')
            ->toArray();

        foreach ($pendingApplicants as $applicantId) {
            $this->ensureAdmissionExists($applicantId);
        }

        Applicant::whereIn('id', $pendingApplicants)
            ->update(['status' => 'interview']);

        Admission::whereIn('applicant_id', $pendingApplicants)
            ->update([
                'interview_schedule_id' => $scheduleId,
                'interview_result' => 'pending',
            ]);

        return [
            'processed' => count($pendingApplicants),
            'skipped' => count($applicantIds) - count($pendingApplicants),
        ];
    }

    protected function ensureAdmissionExists(int $applicantId): Admission
    {
        return Admission::firstOrCreate(
            ['applicant_id' => $applicantId],
            [
                'interview_result' => 'pending',
                'exam_result' => 'pending',
                'decision' => 'pending',
            ]
        );
    }
}
```

---

## 9. API Resource Classes for JSON Responses

### Suggested Improvement

Use Laravel API Resources for consistent JSON output.

#### Create `app/Http/Resources/ApplicantResource.php`:

```php
<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'application_no' => $this->application_no,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'status' => $this->status,
            'status_badge_class' => $this->status_badge_class,
            'admission' => new AdmissionResource($this->whenLoaded('admission')),
            'created_at' => $this->created_at->toISOString(),
        ];
    }
}
```

---

## 10. Constants/Enums for Status Values

### Current Issue

Status strings are hardcoded throughout the codebase.

### Suggested Improvement

Create an Enum (PHP 8.1+):

```php
<?php

namespace App\Enums;

enum ApplicantStatus: string
{
    case Pending = 'pending';
    case Interview = 'interview';
    case Exam = 'exam';
    case Evaluation = 'evaluation';
    case Admitted = 'admitted';
    case Rejected = 'rejected';

    public function label(): string
    {
        return match($this) {
            self::Pending => 'Pending',
            self::Interview => 'For Interview',
            self::Exam => 'For Examination',
            self::Evaluation => 'For Evaluation',
            self::Admitted => 'Admitted',
            self::Rejected => 'Rejected',
        };
    }

    public function badgeClass(): string
    {
        return match($this) {
            self::Pending => 'badge-warning',
            self::Interview, self::Exam, self::Evaluation => 'badge-info',
            self::Admitted => 'badge-success',
            self::Rejected => 'badge-error',
        };
    }
}
```

---

## Priority Implementation Order

1. **High Priority** (Quick wins, high impact):
    - Model Accessors for names (Item 1)
    - HasFullName Trait (Item 2)
    - Query Scopes (Item 6)

2. **Medium Priority** (Refactoring):
    - Status Enum (Item 10)
    - Form Request Classes (Item 7)
    - Service Classes (Item 8)

3. **Lower Priority** (Nice to have):
    - API Resources (Item 9)
    - Money Formatting (Item 4)
    - Address Formatting (Item 3)

---

## Benefits Summary

| Improvement   | Benefit                               |
| ------------- | ------------------------------------- |
| Accessors     | DRY code, consistent formatting       |
| Traits        | Code reuse across models              |
| Scopes        | Cleaner controllers, testable queries |
| Enums         | Type safety, centralized constants    |
| Services      | Separation of concerns, testability   |
| Form Requests | Validation reuse, cleaner controllers |

---

_Document created: March 2026_
