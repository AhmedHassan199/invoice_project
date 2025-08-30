<?php

namespace App\Repositories\Contracts;

use App\Models\Invoice;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface InvoiceRepositoryInterface {
    public function paginateForUser(int $userId, ?string $q = null, int $perPage = 10): LengthAwarePaginator;
    public function findForUser(int $userId, int $id): ?Invoice;
    public function createWithItems(array $invoiceData, array $items): Invoice;
    public function updateWithItems(Invoice $invoice, array $invoiceData, array $items): Invoice;
    public function delete(Invoice $invoice): void;
}
