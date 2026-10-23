<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';
const props = defineProps({
patient: Object,
});
// nilai awal dari data lama, bukan string kosong
const form = useForm({
no_rm: props.patient.no_rm,
nama: props.patient.nama,
usia: props.patient.usia,
alamat: props.patient.alamat,
diagnosa: props.patient.diagnosa,
});
function submit() {
// put() karena ini operasi Update, mengarah ke method update()
form.put(route('patients.update', props.patient.id));
}
</script>
<template>
    <AuthenticatedLayout>
        <div class="p-6">
            <h1 class="text-xl font-bold mb-2">Edit Pasien</h1>
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
1">Simpan Perubahan</button>
 </form>
        </div>
    </AuthenticatedLayout>
</template>