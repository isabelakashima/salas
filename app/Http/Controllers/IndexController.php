<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Reserva;
use App\Models\Sala;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function search(Request $request)
    {
        $reservas = Reserva::make()
            ->when($request->busca_nome, function ($query) use ($request) {
                $query->where('nome', 'LIKE', '%'.$request->busca_nome.'%')
                    ->orderBy('data', 'DESC');
            })
            ->when($request->busca_data, function ($query) use ($request) {
                $query->whereDate('data', Carbon::createFromFormat('d/m/Y', $request->busca_data)->format('Y-m-d'));
            })
            ->when($request->filter, function ($query) use ($request) {
                $salas = Sala::select('id')->whereIn('categoria_id', $request->filter)->pluck('id');
                $query->whereIn('sala_id', $salas->toArray());
            });

        $reservas = $reservas->orderBy('horario_inicio', 'ASC')->paginate(20);

        return view('home', [
            'categorias' => Categoria::all(),
            'filter' => ($request->filter) ?: [],
            'reservas' => $reservas,
        ]);
    }

    public function home(Request $request)
    {
        $data = today();
        $reservas = Reserva::whereDate('data', $data)->orderBy('horario_inicio', 'ASC')->paginate(20);

        return view('home', [
            'categorias' => Categoria::all(),
            'filter' => ($request->filter) ?: [],
            'reservas' => $reservas,
        ]);
    }
}
