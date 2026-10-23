<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { ref } from 'vue';
const props = defineProps({
    patients: Object,
    search: String,
});
// nilai awal kotak pencarian dari props.search
const keyword = ref(props.search);
// dijalankan saat Enter ditekan: memicu index() dengan ?search=...
function cari() {
    router.get('/patients', { search: keyword.value });
}
function hapus(id) {
    // confirm() menampilkan dialog Ya/Batal sebelum data dihapus permanen
    if (confirm('Yakin ingin menghapus data pasien ini?')) {
        router.delete(route('patients.destroy', id));
    }
}
</script>
<template>
    <AuthenticatedLayout>
        <div class="p-6">
            <h1 class="text-xl font-bold mb-2">Data Pasien</h1>
            <!-- flash message, tersedia berkat HandleInertiaRequests -->
            <div v-if="$page.props.flash.success" class="text-green-600 mb
2">
                {{ $page.props.flash.success }}
            </div>
            <div class="flex items-center gap-4">
                <Link href="/patients/create" class="text-blue-600">+ Tambah 
Pasien</Link>
                <input
                    v-model="keyword"
                    @keyup.enter="cari"
                    type="text"
                    placeholder="Cari nama atau no. RM..."
                    class="border"
                >
            </div>
            <table class="w-full mt-4 text-left">
                <thead>
                    <tr>
                        <th>No. RM</th>
                        <th>Nama</th>
                        <th>Usia</th>
                        <th>Alamat</th>
                        <th>Diagnosa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="patient in patients.data" :key="patient.id">
                        <td>{{ patient.no_rm }}</td>
                        <td>{{ patient.nama }}</td>
                        <td>{{ patient.usia }}</td>
                        <td>{{ patient.alamat }}</td>
                        <td>{{ patient.diagnosa }}</td>
                        <td>
                            <Link :href="`/patients/${patient.id}/edit`" 
class="text-blue-600 mr-2">Edit</Link>
                            <button @click="hapus(patient.id)" class="text
red-600">Hapus</button>
                        </td>
                    </tr>
                </tbody> 
                </table>
</div>
</AuthenticatedLayout>
</template>