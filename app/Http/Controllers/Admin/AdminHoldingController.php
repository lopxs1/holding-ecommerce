<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Holding;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminHoldingController extends Controller
{
    public function index()
    {
        $holdings = Holding::with('category')->latest()->paginate(15);
        return view('admin.holdings.index', compact('holdings'));
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id');
        return view('admin.holdings.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:50',
            'address'     => 'required|string|max:50',
            'description' => 'required|string|max:50',
            'owner'       => 'required|string|max:50',
            'regisdate'   => 'required|date',
            'photo'       => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $data['regisdate'] = Carbon::parse($data['regisdate']);
        Holding::create($data);

        return redirect()->route('admin.holdings.index')->with('success', 'Imóvel criado.');
    }

    public function edit(Holding $holding)
    {
        $categories = Category::pluck('name', 'id');
        return view('admin.holdings.edit', compact('holding', 'categories'));
    }

    public function update(Request $request, Holding $holding)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:50',
            'address'     => 'required|string|max:50',
            'description' => 'required|string|max:50',
            'owner'       => 'required|string|max:50',
            'regisdate'   => 'required|date',
            'photo'       => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $data['regisdate'] = Carbon::parse($data['regisdate']);
        $holding->update($data);

        return redirect()->route('admin.holdings.index')->with('success', 'Imóvel atualizado.');
    }

    public function destroy(Holding $holding)
    {
        $temPedidos = $holding->orderItems()->exists();
        if ($temPedidos) {
            return redirect()
                ->route('admin.holdings.index')
                ->with('error', 'Imóvel vinculado a pedidos. Remova os pedidos/itens antes de excluir.');
        }

        $holding->delete();
        return redirect()->route('admin.holdings.index')->with('success', 'Imóvel removido.');
    }
}
