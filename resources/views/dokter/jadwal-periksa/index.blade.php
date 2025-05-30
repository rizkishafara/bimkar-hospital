<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight
text-gray-800">
            {{ __('Jadwal Periksa') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg" <section>
                <header class="flex items-center justify-between">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Daftar Jadwal Periksa') }}
                    </h2>
                    <div class="flex-col items-center justify-center text-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal"

                            data-target="#createJadwalModal">Tambah
                            Jadwal Periksa</button>
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
                        id="createJadwalModal" tabindex="-1" role="dialog"
                        aria-labelledby="detailModalTitle"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h5 class="modal-title font-weight-bold" id="riwayatModalLabel">
                                        Detail Riwayat
                                        Pemeriksaan
                                    </h5>
                                    <button type="button"
                                        class="close" data-dismiss="modal" aria-label="Close">
                                        <span
                                            aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <form id="formJadwal"
                                        action="{{ route('dokter.jadwal-periksa.store') }}"
                                        method="POST">
                                        @csrf
                                        <div class="mb-3 form-group">
                                            <label
                                                for="hariSelect">Hari</label>
                                            <select
                                                class="form-control" name="hari" id="hariSelect" required>
                                                <option
                                                    value="">Pilih Hari</option>

                                                <option>Senin</option>

                                                <option>Selasa</option>

                                                <option>Rabu</option>

                                                <option>Kamis</option>

                                                <option>Jumat</option>

                                                <option>Sabtu</option>

                                                <option>Minggu</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label
                                                for="jamMulai">Jam Mulai</label>
                                            <input type="time"
                                                class="form-control" id="jamMulai" name="jam_mulai"
                                                required>
                                        </div>
                                        <div class="mb-4 form-group">
                                            <label
                                                for="jamSelesai">Jam Selesai</label>
                                            <input type="time"
                                                class="form-control" id="jamSelesai"

                                                name="jam_selesai" required>
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

                                        onclick="document.getElementById('formJadwal').submit();"
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
                            <th scope="col">Hari</th>
                            <th scope="col">Mulai</th>
                            <th scope="col">Selesai</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwalPeriksas as $jadwalPeriksa)
                        <tr>
                            <th scope="row"
                                class="align-middle text-start">{{ $loop->iteration }}</th>
                            <td class="align-middle text-start">{{ $jadwalPeriksa->hari }}</td>
                            <td class="align-middle text-start">
                                {{\Carbon\Carbon::parse($jadwalPeriksa->jam_mulai)->format('H.i')}}
                            </td>
                            <td class="align-middle text-start">
                                {{\Carbon\Carbon::parse($jadwalPeriksa->jam_selesai)->format('H.i')}}
                            </td>
                            <td class="align-middle text-start">
                                @if ($jadwalPeriksa->status)
                                <span class="badge badge-pill badge-success">Aktif</span>
                                @else
                                <span class="badge badge-pill badge-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="align-middle text-start">
                                <form action="{{ route('dokter.jadwal-periksa.update', $jadwalPeriksa->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PATCH')
                                    @if (!$jadwalPeriksa->status)
                                    <button type="submit" class="btn btn-success btn-sm">Aktifkan</button>
                                    @else
                                    <button type="submit" class="btn btn-danger btn-sm">Nonaktifkan</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </section>
            </div>
        </div>
</x-app-layout>
