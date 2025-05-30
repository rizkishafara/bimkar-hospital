<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight
text-gray-800">
            {{ __('Obat') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg" <section>
                <header class="flex items-center justify-between">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Daftar Obat') }}
                    </h2>
                    <div class="flex-col items-center justify-center text-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal"

                            data-target="#createObatModal">Tambah
                            Obat</button>
                        @if (session('status') ===
                        'jadwal-periksa-created')
                        <p x-data="{ show: true }"
                            x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600">{{ __('Created.') }}</p>
                        @endif
                        @if (session('status') === 'jadwal-periksa-exists')
                        <p x-data="{ show: true }"
                            x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600">{{ __('Exists.') }}</p>
                        @endif
                    </div>
                    {{-- Modal --}}
                    <div class="modal fade bd-example-modal-lg"
                        id="createObatModal" tabindex="-1" role="dialog"
                        aria-labelledby="detailModalTitle"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h5 class="modal-title font-weight-bold" id="riwayatModalLabel">
                                        Detail Obat
                                    </h5>
                                    <button type="button"
                                        class="close" data-dismiss="modal" aria-label="Close">
                                        <span
                                            aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <form id="formObat"
                                        action="{{ route('dokter.obat.store') }}"
                                        method="POST">
                                        @csrf
                                        <div class="mb-3 form-group">
                                            <label
                                                for="namaObat">Nama Obat</label>
                                            <input type="text"
                                                class="form-control" id="namaObat" name="nama_obat"
                                                required>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label
                                                for="kemasan">Kemasan</label>
                                            <input type="text"
                                                class="form-control" id="kemasan" name="kemasan"
                                                required>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label
                                                for="harga">Harga</label>
                                            <input type="number"
                                                class="form-control" id="harga" name="harga"
                                                required>
                                        </div>
                                    </form>
                                </div>
                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button"
                                        class="btn btn-secondary" data-dismiss="modal">
                                        Tutup
                                    </button>
                                    <button type="button"
                                        class="btn btn-primary"

                                        onclick="document.getElementById('formObat').submit();"
                                        data-dismiss="modal">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <table class="table mt-6 overflow-hidden rounded table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Obat</th>
                            <th scope="col">Kemasan</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($obats as $obat)
                        <tr>
                            <th scope="row"
                                class="align-middle text-start">{{ $loop->iteration }}</th>
                            <td class="align-middle text-start">{{ $obat->nama_obat }}</td>
                            <td class="align-middle text-start">{{ $obat->kemasan }}</td>
                            <td class="align-middle text-start">{{ $obat->harga }}</td>
                            <td class="align-middle text-start">
                                <div class="flex justify-start">
                                    <button type="button" class="btn btn-primary btn-sm me-2"
                                        data-toggle="modal"
                                        data-target="#editObatModal{{ $obat->id }}">Edit</button>
                                    <form action="{{ route('dokter.obat.destroy', $obat->id) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </div>
                                <!-- Modal Edit -->
                                <div class="modal fade" id="editObatModal{{ $obat->id }}" tabindex="-1" role="dialog" aria-labelledby="editObatModalLabel{{ $obat->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h5 class="modal-title font-weight-bold" id="editObatModalLabel{{ $obat->id }}">
                                                    Edit Obat
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <!-- Modal Body -->
                                            <div class="modal-body">
                                                <form id="formEditObat{{ $obat->id }}" action="{{ route('dokter.obat.update', $obat->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="mb-3 form-group">
                                                        <label for="namaObat{{ $obat->id }}">Nama Obat</label>
                                                        <input type="text" class="form-control" id="namaObat{{ $obat->id }}" name="nama_obat" value="{{ $obat->nama_obat }}" required>
                                                    </div>
                                                    <div class="mb-3 form-group">
                                                        <label for="kemasan{{ $obat->id }}">Kemasan</label>
                                                        <input type="text" class="form-control" id="kemasan{{ $obat->id }}" name="kemasan" value="{{ $obat->kemasan }}" required>
                                                    </div>
                                                    <div class="mb-3 form-group">
                                                        <label for="harga{{ $obat->id }}">Harga</label>
                                                        <input type="number" class="form-control" id="harga{{ $obat->id }}" name="harga" value="{{ $obat->harga }}" required>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- Modal Footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Tutup
                                                </button>
                                                <button type="button" class="btn btn-primary" onclick="document.getElementById('formEditObat{{ $obat->id }}').submit();" data-dismiss="modal">
                                                    Simpan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </section>
            </div>
        </div>
</x-app-layout>