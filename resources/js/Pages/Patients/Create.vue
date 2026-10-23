<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';
// useForm mengelola nilai input dan pesan error validasi
const form = useForm({
    no_rm: '',
    nama: '',
    usia: '',
    alamat: '',
    diagnosa: '',
});
function submit() {
    // kirim ke route patients.store (method store() di controller)
    form.post(route('patients.store'));
}
</script>
<template>
    <AuthenticatedLayout>
        <div class="p-6">
            <h1 class="text-xl font-bold mb-2">Tambah Pasien</h1>
            <form @submit.prevent="submit" class="space-y-2">
                <div>
                    <label>No. RM</label><br>
                    <input v-model="form.no_rm" type="text" class="border">
                    <div v-if="form.errors.no_rm" class="text-red-600">{{ 
form.errors.no_rm }}</div>
                </div>
                <div>
                    <label>Nama</label><br>
                    <input v-model="form.nama" type="text" class="border">
                    <div v-if="form.errors.nama" class="text-red-600">{{ 
form.errors.nama }}</div>
                </div>
                <div>
                    <label>Usia</label><br>
                    <input v-model="form.usia" type="number" class="border">
                    <div v-if="form.errors.usia" class="text-red-600">{{ 
form.errors.usia }}</div>
                </div>
                <div>
                    <label>Alamat</label><br>
                    <input v-model="form.alamat" type="text" class="border">
                    <div v-if="form.errors.alamat" class="text-red-600">{{ 
form.errors.alamat }}</div>
                </div>
                <div>
                    <label>Diagnosa</label><br>
                    <input v-model="form.diagnosa" type="text" 
class="border">
                    <div v-if="form.errors.diagnosa" class="text-red-600">{{ 
form.errors.diagnosa }}</div>
                </div>
                <button type="submit" class="bg-gray-800 text-white px-4 py
1">Simpan</button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>