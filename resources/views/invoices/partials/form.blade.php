@php($invoice = $invoice ?? null)
<div class="row mb-3">
<div class="col-md-6">
<label class="form-label form-required">Client</label>
<select name="client_id" class="form-select" required>
    <option value="">-- Select client --</option>
    @foreach($clients as $c)
    <option value="{{ $c->id }}" @selected(old('client_id', $invoice->client_id ?? '') == $c->id)>{{ $c->name }}</option>
    @endforeach
</select>
</div>
<div class="col-md-3">
<label class="form-label form-required">Invoice Date</label>
<input type="date" required  name="invoice_date" class="form-control" value="{{ old('invoice_date', optional($invoice)->invoice_date?->format('Y-m-d')) ?? date('Y-m-d') }}" required>
</div>
<div class="col-md-3">
<label class="form-label">Due Date</label>
<input type="date" required name="due_date" class="form-control" value="{{ old('due_date', optional($invoice)->due_date?->format('Y-m-d')) }}">
</div>
</div>

<h6>Items</h6>
<div class="table-responsive mb-2">
<table class="table" id="items-table">
<thead>
    <tr><th>Description</th><th style="width:120px">Qty</th><th style="width:160px">Unit Price</th><th style="width:160px">Total</th><th style="width:80px"></th></tr>
</thead>
<tbody>
    @php($rows = old('items', $invoice?->items?->toArray() ?? [['description'=>'','quantity'=>1,'unit_price'=>0,'total'=>0]]))
    @foreach($rows as $i => $it)
    <tr>
    <td><input class="form-control desc" name="items[{{ $i }}][description]" value="{{ $it['description'] ?? '' }}" required></td>
    <td><input class="form-control qty" type="number" min="1" name="items[{{ $i }}][quantity]" value="{{ $it['quantity'] ?? 1 }}" required></td>
    <td><input class="form-control price" type="number" step="0.01" min="0" name="items[{{ $i }}][unit_price]" value="{{ $it['unit_price'] ?? 0 }}" required></td>
    <td><input class="form-control total" type="number" step="0.01" min="0" name="items[{{ $i }}][total]" value="{{ $it['total'] ?? 0 }}" readonly></td>
    <td><button type="button" class="btn btn-outline-danger btn-sm remove-row">&times;</button></td>
    </tr>
    @endforeach
</tbody>
</table>
</div>
<button type="button" class="btn btn-outline-secondary btn-sm mb-3" id="add-row">+ Add Item</button>

<div class="text-end mb-3">
<strong>Grand Total: <span id="grand-total">0.00</span></strong>
</div>

@push('scripts')
<script>
(function(){
const table = document.getElementById('items-table').getElementsByTagName('tbody')[0];
const addBtn = document.getElementById('add-row');
function recalcRow(tr){
const qty = parseFloat(tr.querySelector('.qty').value||0);
const price = parseFloat(tr.querySelector('.price').value||0);
tr.querySelector('.total').value = (qty*price).toFixed(2);
recalcGrand();
}
function recalcGrand(){
let g=0;
table.querySelectorAll('.total').forEach(t=>{ g += parseFloat(t.value||0); });
document.getElementById('grand-total').innerText = g.toFixed(2);
}
table.addEventListener('input', function(e){
if(e.target.classList.contains('qty') || e.target.classList.contains('price')){
    recalcRow(e.target.closest('tr'));
}
});
table.addEventListener('click', function(e){
if(e.target.classList.contains('remove-row')){
    e.target.closest('tr').remove();
    recalcGrand();
}
});
addBtn.addEventListener('click', function(){
const idx = table.querySelectorAll('tr').length;
const tr = document.createElement('tr');
tr.innerHTML = `
    <td><input class="form-control desc" name="items[${idx}][description]" required></td>
    <td><input class="form-control qty" type="number" min="1" name="items[${idx}][quantity]" value="1" required></td>
    <td><input class="form-control price" type="number" step="0.01" min="0" name="items[${idx}][unit_price]" value="0" required></td>
    <td><input class="form-control total" type="number" step="0.01" min="0" name="items[${idx}][total]" value="0" readonly></td>
    <td><button type="button" class="btn btn-outline-danger btn-sm remove-row">&times;</button></td>
`;
table.appendChild(tr);
});

table.querySelectorAll('tr').forEach(recalcRow);
})();
</script>
@endpush
