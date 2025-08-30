<?php

namespace App\Repositories;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Repositories\Contracts\InvoiceRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function paginateForUser(int $userId, ?string $q = null, int $perPage = 10): LengthAwarePaginator
    {
        $query = Invoice::with('client')
            ->where('user_id', $userId);

        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('invoice_number', 'like', "%$q%")
                    ->orWhereHas('client', fn($c) => $c->where('name', 'like', "%$q%"));
            });
        }

        return $query->latest()->paginate($perPage)->withQueryString();
    }

    public function findForUser(int $userId, int $id): ?Invoice {
        return Invoice::with('client','items')->where('user_id',$userId)->find($id);
    }

    public function createWithItems(array $invoiceData, array $items): Invoice {
        return DB::transaction(function() use ($invoiceData,$items){
            $invoice = Invoice::create($invoiceData);
            $total = 0;
            foreach ($items as $it) {
                $lineTotal = (int)$it['quantity'] * (float)$it['unit_price'];
                $total += $lineTotal;
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'description'=> $it['description'],
                    'quantity'   => $it['quantity'],
                    'unit_price' => $it['unit_price'],
                    'total'      => $lineTotal,
                ]);
            }
            $invoice->update(['total_amount'=>$total]);
            return $invoice->load('items','client');
        });
    }

    public function updateWithItems(Invoice $invoice, array $invoiceData, array $items): Invoice {
        return DB::transaction(function() use ($invoice,$invoiceData,$items){
            $invoice->update($invoiceData);
            $invoice->items()->delete();

            $total = 0;
            foreach ($items as $it) {
                $lineTotal = (int)$it['quantity'] * (float)$it['unit_price'];
                $total += $lineTotal;
                $invoice->items()->create([
                    'description'=> $it['description'],
                    'quantity'   => $it['quantity'],
                    'unit_price' => $it['unit_price'],
                    'total'      => $lineTotal,
                ]);
            }
            $invoice->update(['total_amount'=>$total]);
            return $invoice->load('items','client');
        });
    }

    public function delete(Invoice $invoice): void {
        $invoice->delete();
    }
}
