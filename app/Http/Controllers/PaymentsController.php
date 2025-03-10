<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentPostRequest;
use App\Http\Requests\PaymentPutRequest;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Get all payments with pagination.
     * The payments are obtained with pagination of 20 in 20.
     * If the page number is not specified, the first page is obtained.
     *
     * @param int page : The page number.
     * @return JsonResponse
     */
    public function index(): JsonResponse {
        // Get all payments with pagination
        $payments = Payment::paginate(20);

        return response()->json($payments);
    }

    /**
     * Get a payment by its ID.
     *
     * @param int $id : The payment ID.
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        // Search the payment by its ID
        $payment = Payment::where('payment_id', $id)->first();

        // If the payment does not exist, return an error
        if (!$payment) {
            return response()->json(['message' => 'Payment not found.'], 404);
        }

        return response()->json($payment);
    }

    /**
     * Create a new payment.
     *
     * @param PaymentPostRequest $request : The request object.
     * @return JsonResponse
     */
    public function store(PaymentPostRequest $request): JsonResponse {
        // Validate the request data
        $request->validated();

        // Create the payment
        $payment = Payment::create([
            'customer_id' => $request->input('customer_id'),
            'staff_id' => $request->input('staff_id'),
            'rental_id' => $request->input('rental_id'),
            'amount' => $request->input('amount'),
            'payment_date' => $request->input('payment_date'),
            'last_update' => now(),
        ]);

        return response()->json($payment, 201);
    }

    /**
     * Update a payment by its ID.
     *
     * @param PaymentPutRequest $request : The request object.
     * @param int $id : The payment ID.
     * @return JsonResponse
     */
    public function update(PaymentPutRequest $request, int $id): JsonResponse {
        // Validate the request data
        $request->validated();

        // Search the payment by its ID
        $payment = Payment::where('payment_id', $id)->first();

        // If the payment does not exist, return an error
        if (!$payment) {
            return response()->json(['message' => 'Payment not found.'], 404);
        }

        // Update only provided fields
        $payment->fill($request->only(['customer_id', 'staff_id', 'rental_id', 'amount', 'payment_date']));
        $payment->last_update = now();
        $payment->save();

        return response()->json($payment);
    }

    /**
     * Delete a payment by its ID.
     *
     * @param int $id : The payment ID.
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        // Search the payment by its ID
        $payment = Payment::where('payment_id', $id)->first();

        // If the payment does not exist, return an error
        if (!$payment) {
            return response()->json(['message' => 'Payment not found.'], 404);
        }

        // Delete the payment
        $payment->delete();

        return response()->json(['message' => 'Payment deleted.']);
    }
}
