<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donante;
use App\Models\Donacion;
use Illuminate\Validation\ValidationException;
use App\Utils\ApiResponse;

class DonanteController extends Controller
{
    public function obtenerTodosDonantes()
    {
        $listaDonantes = Donante::all();
        return ApiResponse::success(
            'Lista de donantes registrados',
            $listaDonantes,
            200
        );
    }
    public function obtenerDonantePorId($id)
    {

        $donante = Donante::with('donaciones')->find($id);

        if (!$donante) {
            return ApiResponse::error(
                'Donante no encontrado',
                404
            );
        }
        return ApiResponse::success(
            'Donante encontrado',
            $donante
        );
    }

    public function crearDonante(Request $request)
    {
        try {
            $datosValidados = $request->validate([
                'nombre' => 'required|string|max:100',
                'apellidos' => 'required|string|max:150',
                'grupo_sanguineo' => 'required|string|max:5',
                'contacto' => 'required|string|max:20|unique:donantes,contacto',
                'fecha_nacimiento' => 'required|date',
                'ciudad_residencia' => 'required|string|max:100',
                'observaciones' => 'nullable|string'
            ]);

            $donante = Donante::create($datosValidados);

            return ApiResponse::success(
                "El donante ha sido creado correctamente",
                $donante,
                201
            );
        } catch (ValidationException $e) {
            return ApiResponse::error(
                'Error de validación, datos erroneos',
                422,
                $e->errors()
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Error: no se ha podido crear el donante',
                500
            );
        }
    }
    public function actualizarDonante(Request $request, $id)
    {
        $donante = Donante::find($id);

        if (!$donante) {
            return ApiResponse::error(
                'Donante no encontrado',
                404
            );
        }
        try {
            $datosValidados = $request->validate([
                'nombre' => 'sometimes|string|max:100',
                'apellidos' => 'sometimes|string|max:200',
                'grupo_sanguineo' => 'sometimes|string|max:5',
                'contacto' => 'sometimes|string|max:20|unique:donantes,contacto,' . $id . ',id_donante',
                'fecha_nacimiento' => 'sometimes|date',
                'ciudad_residencia' => 'sometimes|string|max:100',
                'observaciones' => 'nullable|string'
            ]);
            // Si no llegó ningún dato válido
            if (empty($datosValidados)) {
                return ApiResponse::error(
                    'No se ha enviado ningún dato válido para actualizar',
                    400
                );
            }

            $donante->update($datosValidados);

            return ApiResponse::success(
                "El donante ha sido actualizado correctamente",
                $donante,
                200
            );
        } catch (ValidationException $e) {
            return ApiResponse::error(
                'Error de validación, datos erroneos',
                422,
                $e->errors()
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Error: no se ha podido actualizar el donante',
                500,
                $e->getMessage()
            );
        }
    }

    public function borrarDonante($id)
    {
        $donante = Donante::find($id);

        if (!$donante) {
            return ApiResponse::error(
                'Donante no encontrado',
                404
            );
        }
        $donante->delete();
        return ApiResponse::success(
            'Donante eliminado correctamente',
            null,
            200
        );
    }

    public function crearDonacion(Request $request)
    {
        try {
            $datosValidados = $request->validate([

                'id_donante' => 'required|integer',
                'fecha_donacion' => 'required|date',
                'centro' => 'required|string|max:100',
                'tipo_donacion' => 'required|string|max:50',
                'cantidad_ml' => 'required|integer|max_digits:11'

            ]);
            $donante = Donante::find($datosValidados['id_donante']);
            if (!$donante) {
                return ApiResponse::error(
                    'El donante no existe',
                    404
                );
            }

            $donacion = Donacion::create($datosValidados);
            return ApiResponse::success(
                'Donacion creada correctamente',
                $donacion,
                201
            );
        } catch (ValidationException $e) {
            return ApiResponse::error(
                'Error de validación, datos erroneos',
                422,
                $e->errors()
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'La donación no ha sido creada',
                500
            );
        }
    }
}
