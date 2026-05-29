<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CertificateController extends Controller
{
  public function view(Certificate $certificate): BinaryFileResponse
  {
    $this->authorizeCertificate($certificate);

    $path = public_path($certificate->file_path);

    abort_unless(is_file($path), 404);

    return Response::file($path);
  }

  public function download(Certificate $certificate): BinaryFileResponse
  {
    $this->authorizeCertificate($certificate);

    $path = public_path($certificate->file_path);

    abort_unless(is_file($path), 404);

    return Response::download($path);
  }

  private function authorizeCertificate(Certificate $certificate): void
  {
    $certificate->loadMissing('registration');

    abort_unless(Auth::id() === $certificate->registration->user_id, 403);
  }
}
