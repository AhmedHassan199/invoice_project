<?php

namespace App\Services;

use App\Models\Invoice;
use App\Repositories\Contracts\InvoiceRepositoryInterface;
use Illuminate\Support\Str;

class InvoiceService
{
    public function __construct(private InvoiceRepositoryInterface $invoices) {}

    public function paginate(int $userId, ?string $q = null, int $perPage = 10) {
        return $this->invoices->paginateForUser($userId,$q,$perPage);
    }

    public function find(int $userId, int $id): ?Invoice {
        return $this->invoices->findForUser($userId,$id);
    }

    public function create(int $userId, array $data, array $items): Invoice {
        $data['user_id'] = $userId;
        $data['invoice_number'] = $this->generateInvoiceNumber();
        return $this->invoices->createWithItems($data,$items);
    }

    public function update(Invoice $invoice, array $data, array $items): Invoice {
        return $this->invoices->updateWithItems($invoice,$data,$items);
    }

    public function delete(Invoice $invoice): void {
        $this->invoices->delete($invoice);
    }

    private function generateInvoiceNumber(): string {
        return 'INV-'.now()->format('Ymd').'-'.Str::upper(Str::random(4));
    }
}
