<x-layout>
    <x-slot:title>Ovoz berganlar</x-slot:title>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ovozberganlar</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Ism</th>
                            <th>Email</th>
                            <th>Kimga ovoz bergan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($voters as $voter)
                            <tr>
                                <td>{{ $voter->name }}</td>
                                <td>{{ $voter->email }}</td>
                                <td>{{ $voter->candidate->name ?? 'Hali hechkimga ovoz bermagan' }}</td>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
