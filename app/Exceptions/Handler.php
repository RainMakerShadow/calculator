public function render($request, Throwable $exception)
{
return response()->json(['error' => $exception->getMessage()], 500);
}
