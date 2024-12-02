<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard - SPK MOORA - Kelompok 2') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Dashboard Content Start -->

                <div class="p-6">
                    <!-- Penjelasan SPK MOORA -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-gray-800">Apa itu SPK MOORA?</h3>
                        <p class="text-gray-700 mt-4">
                            <strong>SPK MOORA (Multi-Objective Optimization on the Basis of Ratio Analysis)</strong> adalah metode yang digunakan dalam pengambilan keputusan yang melibatkan banyak alternatif dan kriteria. MOORA membantu memilih alternatif terbaik berdasarkan kriteria yang telah ditetapkan.<br><br>

                            <strong>Proses Pengambilan Keputusan dengan MOORA </strong>:<br>
                        <ul class="list-disc ml-6 mt-2">
                            <li><strong>Langkah 1: Normalisasi Matriks</strong> - Setiap kriteria dinormalisasi agar semua atribut yang digunakan dapat dibandingkan dengan adil. Nilai atribut ini akan dibandingkan dalam bentuk rasio.</li>
                            <li><strong>Langkah 2: Pemberian Bobot</strong> - Setiap kriteria diberi bobot sesuai kepentingannya. Bobot ini mencerminkan seberapa besar pengaruh setiap kriteria terhadap keputusan akhir.</li>
                            <li><strong>Langkah 3: Penghitungan Rasio</strong> - Setelah normalisasi, setiap alternatif dihitung rasio untuk setiap kriteria, kemudian dijumlahkan untuk mendapatkan nilai total.</li>
                            <li><strong>Langkah 4: Ranking</strong> - Alternatif yang memiliki nilai tertinggi dianggap terbaik, sedangkan alternatif dengan nilai terendah dianggap paling tidak menguntungkan.</li>
                        </ul>
                        MOORA sangat efektif dalam keputusan yang melibatkan berbagai kriteria yang seringkali bertentangan, seperti mengoptimalkan biaya dan kualitas secara bersamaan.
                        </p>
                    </div>

                    <!-- Deskripsi Konteks Kasus -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-gray-800">Deskripsi Kasus</h3>
                        <p class="text-gray-700 mt-4">
                            • <strong>PT. ABC</strong> adalah perusahaan yang bergerak di bidang <strong>consumer goods</strong> yang akan menginvestasikan sisa usahanya dalam satu tahun.<br>
                            • Beberapa alternatif investasi telah diidentifikasi, dan pemilihan alternatif terbaik ditujukan selain untuk keperluan investasi, juga dalam rangka meningkatkan kinerja perusahaan ke depan.<br>
                            • Ada 5 kriteria yang dijadikan acuan dalam pengambilan keputusan:
                        <ul class="list-disc ml-6 mt-2">
                            <li><strong>C1</strong> = Harga (<strong>Cost</strong>)</li>
                            <li><strong>C2</strong> = Nilai investasi 10 tahun ke depan (<strong>Benefit</strong>)</li>
                            <li><strong>C3</strong> = Daya dukung terhadap produktivitas perusahaan (<strong>Benefit</strong>)
                                <ul class="list-disc ml-6 mt-1">
                                    <li>1 = kurang mendukung, 2 = cukup mendukung; 3 = mendukung dan 4 = sangat mendukung</li>
                                </ul>
                            </li>
                            <li><strong>C4</strong> = Prioritas kebutuhan (<strong>Cost</strong>)
                                <ul class="list-disc ml-6 mt-1">
                                    <li>1 = kurang berprioritas, 2 = cukup berprioritas; 3 = berprioritas dan 4 = sangat berprioritas</li>
                                </ul>
                            </li>
                            <li><strong>C5</strong> = Ketersediaan atau kemudahan (<strong>Benefit</strong>)
                                <ul class="list-disc ml-6 mt-1">
                                    <li>1 = sulit diperoleh, 2 = cukup mudah diperoleh; dan 3 = sangat mudah diperoleh</li>
                                </ul>
                            </li>
                        </ul>
                        <br>
                        • Pengambil keputusan memberikan bobot preferensi sebagai berikut:
                        <ul class="list-disc ml-6 mt-2">
                            <li><strong>C1</strong> = 25%</li>
                            <li><strong>C2</strong> = 15%</li>
                            <li><strong>C3</strong> = 30%</li>
                            <li><strong>C4</strong> = 25%</li>
                            <li><strong>C5</strong> = 5%</li>
                        </ul>
                        <br>
                        • Ada empat alternatif yang diberikan, yaitu:
                        <ul class="list-disc ml-6 mt-2">
                            <li><strong>A1</strong> = Membeli mobil box untuk distribusi barang ke gudang</li>
                            <li><strong>A2</strong> = Membeli tanah untuk membangun gudang baru</li>
                            <li><strong>A3</strong> = Maintenance sarana teknologi informasi</li>
                            <li><strong>A4</strong> = Pengembangan produk baru</li>
                        </ul>
                        </p>
                    </div>
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-gray-800">Perhitungan Manual</h3>
                        <p class="text-gray-700 mt-4">
                            Anda dapat mengunduh perhitungan manual dalam format Excel dengan mengklik link berikut:
                            <br>
                            <a href="{{ asset('files/METODE_MOORA_EXCEL.xlsx') }}" class="text-blue-500 hover:text-blue-700" download>
                                <strong>Perhitungan Manual dengan Excel</strong>
                            </a>
                        </p>
                    </div>

                    <!-- Tabel Hasil Perangkingan -->
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Hasil Perangkingan Alternatif</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-4 py-2 border text-left">No</th>
                                    <th class="px-4 py-2 border text-left">Alternatif</th>
                                    <th class="px-4 py-2 border text-left">Nilai</th>
                                    <th class="px-4 py-2 border text-left">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="hover:bg-gray-100">
                                    <td class="px-4 py-2 border">1</td>
                                    <td class="px-4 py-2 border">A3 (Maintenance sarana teknologi informasi)</td>
                                    <td class="px-4 py-2 border text-green-500">0.0722</td>
                                    <td class="px-4 py-2 border">Alternatif terbaik berdasarkan perhitungan MOORA.</td>
                                </tr>
                                <tr class="hover:bg-gray-100">
                                    <td class="px-4 py-2 border">2</td>
                                    <td class="px-4 py-2 border">A4 (Pengembangan produk baru)</td>
                                    <td class="px-4 py-2 border text-green-500">0.0658</td>
                                    <td class="px-4 py-2 border">Alternatif dengan nilai yang cukup baik.</td>
                                </tr>
                                <tr class="hover:bg-gray-100">
                                    <td class="px-4 py-2 border">3</td>
                                    <td class="px-4 py-2 border">A1 (Membeli mobil box untuk distribusi barang ke gudang)</td>
                                    <td class="px-4 py-2 border text-red-500">-0.0288</td>
                                    <td class="px-4 py-2 border">Alternatif dengan nilai paling rendah.</td>
                                </tr>
                                <tr class="hover:bg-gray-100">
                                    <td class="px-4 py-2 border">4</td>
                                    <td class="px-4 py-2 border">A2 (Membeli tanah untuk membangun gudang baru)</td>
                                    <td class="px-4 py-2 border text-red-500">-0.1122</td>
                                    <td class="px-4 py-2 border">Alternatif dengan nilai terendah, menunjukkan pilihan yang kurang menguntungkan.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Penjelasan Hasil -->
                    <div class="mt-6">
                        <p class="text-gray-700">
                            Berdasarkan hasil perhitungan menggunakan metode MOORA, alternatif yang paling menguntungkan adalah <strong>A3 (Maintenance sarana teknologi informasi)</strong> dengan nilai positif tertinggi. Sedangkan alternatif <strong>A2 (Membeli tanah untuk membangun gudang baru)</strong> memiliki nilai negatif paling rendah, menunjukkan bahwa ini adalah pilihan yang kurang menguntungkan jika dibandingkan dengan alternatif lainnya.
                        </p>
                    </div>
                </div>

                <!-- Dashboard Content End -->
            </div>
        </div>
    </div>
</x-app-layout>