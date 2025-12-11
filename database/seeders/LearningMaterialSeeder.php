<?php

namespace Database\Seeders;

use App\Models\LearningMaterial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LearningMaterialSeeder extends Seeder
{
    public function run(): void
    {
        $materials = [
            // 1. Pendahuluan
            [
                'title' => 'Pengertian Fungsi Kuadrat',
                'slug' => Str::slug('Pengertian Fungsi Kuadrat'),
                'type' => 'pendahuluan',
                'description' => 'Memahami konsep dasar fungsi kuadrat dan karakteristiknya dalam kehidupan sehari-hari',
                'content' => '
                # Pengertian Fungsi Kuadrat

                Fungsi kuadrat adalah fungsi polinom (suku banyak) dengan pangkat tertinggi variabelnya adalah 2. Fungsi kuadrat adalah sebuah fungsi matematika yang dinyatakan dalam bentuk persamaan:

                $$f(x) = ax^2 + bx + c$$

                dimana a, b, dan c adalah konstanta-konstanta tertentu dan x adalah variabel independent.

                ## Komponen Fungsi Kuadrat

                Dalam persamaan $$f(x) = ax^2 + bx + c$$, terdapat:

                - **a** merupakan koefisien dari suku $$x^2$$ dan menentukan apakah grafik fungsi kuadrat tersebut membentuk parabola yang terbuka ke atas ($$a > 0$$) atau terbuka ke bawah ($$a < 0$$)
                - **b** merupakan koefisien dari suku $$x$$ dan menentukan pergeseran parabola secara horizontal
                - **c** merupakan konstanta bebas dan menentukan pergeseran parabola secara vertikal

                ## Contoh dalam Kehidupan Sehari-hari

                Fungsi kuadrat sering kita jumpai dalam kehidupan sehari-hari, seperti:

                1. **Lintasan bola yang dilempar**: Ketika sebuah bola dilempar ke udara, lintasannya membentuk kurva parabola
                2. **Gerak mobil**: Hubungan antara jarak tempuh mobil dengan waktu dapat membentuk fungsi kuadrat
                3. **Antena parabola**: Bentuk antena parabola mengikuti fungsi kuadrat
                4. **Jembatan**: Struktur kabel jembatan gantung membentuk kurva parabola

                ## Mengapa Mempelajari Fungsi Kuadrat?

                Mempelajari fungsi kuadrat penting karena:
                - Membantu memahami fenomena alam yang berbentuk parabola
                - Dasar untuk mempelajari matematika tingkat lanjut
                - Aplikasi dalam berbagai bidang seperti fisika, teknik, dan ekonomi
                - Mengembangkan kemampuan berpikir logis dan analitis
                ',
                'math_symbols' => json_encode([
                    'x^2' => 'x²',
                    'sqrt' => '√',
                    'pm' => '±',
                    'geq' => '≥',
                    'leq' => '≤',
                    'neq' => '≠',
                    'alpha' => 'α',
                    'beta' => 'β'
                ]),
                'references' => json_encode([
                    'Matematika SMA Kelas X - Kemendikbud',
                    'Fungsi Kuadrat dan Aplikasinya - Prof. Dr. Ahmad',
                    'Parabola dalam Kehidupan Sehari-hari - Journal of Mathematics Education'
                ]),
                'order' => 1,
                'min_score' => 70,
                'is_published' => true
            ],

            // 2. Materi Utama
            [
                'title' => 'Karakteristik Fungsi Kuadrat',
                'slug' => Str::slug('Karakteristik Fungsi Kuadrat'),
                'type' => 'materi',
                'description' => 'Mempelajari karakteristik grafik fungsi kuadrat berupa parabola dan sifat-sifatnya',
                'content' => '
                # Karakteristik Fungsi Kuadrat

                Karakteristik fungsi kuadrat ditunjukkan oleh grafiknya yang berbentuk parabola. Grafik fungsi kuadrat memiliki beberapa karakteristik khusus yang perlu dipahami.

                ## 1. Bentuk Parabola

                Grafik fungsi kuadrat $$f(x) = ax^2 + bx + c$$ selalu berbentuk parabola. Arah bukaan parabola ditentukan oleh nilai koefisien $$a$$:

                - Jika $$a > 0$$, parabola terbuka ke atas (memiliki titik minimum)
                - Jika $$a < 0$$, parabola terbuka ke bawah (memiliki titik maksimum)

                ## 2. Sumbu Simetri

                Setiap parabola memiliki sumbu simetri, yaitu garis vertikal yang membagi parabola menjadi dua bagian yang sama. Persamaan sumbu simetri adalah:

                $$x = -\frac{b}{2a}$$

                ## 3. Titik Puncak (Vertex)

                Titik puncak adalah titik tertinggi (jika $$a < 0$$) atau terendah (jika $$a > 0$$) dari parabola. Koordinat titik puncak adalah:

                $$\left(-\frac{b}{2a}, f\left(-\frac{b}{2a}\right)\right)$$

                ## 4. Titik Potong dengan Sumbu Y

                Titik potong dengan sumbu y diperoleh ketika $$x = 0$$, sehingga titik potongnya adalah $$(0, c)$$.

                ## 5. Titik Potong dengan Sumbu X

                Titik potong dengan sumbu x diperoleh ketika $$f(x) = 0$$, sehingga kita perlu menyelesaikan persamaan:

                $$ax^2 + bx + c = 0$$

                Jumlah titik potong dengan sumbu x ditentukan oleh nilai diskriminan:

                $$D = b^2 - 4ac$$

                - Jika $$D > 0$$: ada dua titik potong dengan sumbu x
                - Jika $$D = 0$$: ada satu titik potong dengan sumbu x (menyinggung)
                - Jika $$D < 0$$: tidak ada titik potong dengan sumbu x

                ## Contoh Analisis Karakteristik

                Misalkan fungsi $$f(x) = 2x^2 - 4x - 6$$

                1. **Arah bukaan**: $$a = 2 > 0$$, sehingga parabola terbuka ke atas
                2. **Sumbu simetri**: $$x = -\frac{(-4)}{2(2)} = 1$$
                3. **Titik puncak**: $$(1, f(1)) = (1, -8)$$
                4. **Titik potong sumbu y**: $$(0, -6)$$
                5. **Diskriminan**: $$D = (-4)^2 - 4(2)(-6) = 16 + 48 = 64 > 0$$
                   
                   Sehingga ada dua titik potong dengan sumbu x.
                ',
                'math_symbols' => json_encode([
                    'x^2' => 'x²',
                    'sqrt' => '√',
                    'pm' => '±',
                    'geq' => '≥',
                    'leq' => '≤'
                ]),
                'references' => json_encode([
                    'Analisis Fungsi Kuadrat - Buku Matematika SMA',
                    'Grafik dan Karakteristik Parabola - Mathematics Journal',
                    'Aplikasi Fungsi Kuadrat - Educational Research'
                ]),
                'order' => 2,
                'min_score' => 75,
                'is_published' => true
            ],

            // 3. Latihan
            [
                'title' => 'Menggambar Grafik Fungsi Kuadrat',
                'slug' => Str::slug('Menggambar Grafik Fungsi Kuadrat'),
                'type' => 'latihan',
                'description' => 'Praktik menggambar grafik fungsi kuadrat dan menganalisis karakteristiknya',
                'content' => '
                # Menggambar Grafik Fungsi Kuadrat

                Untuk menggambar grafik fungsi kuadrat, kita perlu mengikuti langkah-langkah sistematis agar menghasilkan grafik yang akurat.

                ## Langkah-langkah Menggambar Grafik

                ### 1. Tentukan Karakteristik Utama

                Dari fungsi $$f(x) = ax^2 + bx + c$$, tentukan:
                - Arah bukaan parabola (nilai $$a$$)
                - Sumbu simetri: $$x = -\frac{b}{2a}$$
                - Titik puncak
                - Titik potong dengan sumbu y
                - Diskriminan untuk menentukan titik potong sumbu x

                ### 2. Buat Tabel Nilai

                Pilih beberapa nilai x di sekitar sumbu simetri dan hitung nilai $$f(x)$$ yang bersesuaian.

                ### 3. Plot Titik-titik pada Koordinat

                Gambar titik-titik yang telah dihitung pada bidang koordinat.

                ### 4. Hubungkan Titik-titik

                Hubungkan titik-titik tersebut membentuk kurva parabola yang mulus.

                ## Contoh: Menggambar $$f(x) = x^2 - 2x - 3$$

                ### Langkah 1: Analisis Karakteristik

                - $$a = 1 > 0$$ → parabola terbuka ke atas
                - Sumbu simetri: $$x = -\frac{(-2)}{2(1)} = 1$$
                - Titik puncak: $$(1, f(1)) = (1, -4)$$
                - Titik potong sumbu y: $$(0, -3)$$
                - Diskriminan: $$D = (-2)^2 - 4(1)(-3) = 4 + 12 = 16 > 0$$

                ### Langkah 2: Tabel Nilai

                | x  | -2 | -1 | 0 | 1 | 2 | 3 | 4 |
                |----|----|----|---|---|---|---|---|
                | f(x) | 5  | 0  | -3| -4| -3| 0 | 5 |

                ### Langkah 3: Mencari Titik Potong Sumbu X

                $$x^2 - 2x - 3 = 0$$
                $$(x - 3)(x + 1) = 0$$
                $$x = 3$$ atau $$x = -1$$

                Jadi titik potong sumbu x adalah $$(-1, 0)$$ dan $$(3, 0)$$.

                ## Aplikasi dalam Kehidupan Nyata

                ### Contoh: Lintasan Bola

                Seorang pemain basket melempar bola dengan lintasan yang mengikuti fungsi:
                $$h(t) = -5t^2 + 10t + 2$$

                dimana $$h(t)$$ adalah ketinggian bola (dalam meter) setelah $$t$$ detik.

                **Analisis:**
                - Ketinggian maksimum: pada $$t = -\frac{10}{2(-5)} = 1$$ detik
                - Ketinggian maksimum: $$h(1) = -5(1)^2 + 10(1) + 2 = 7$$ meter
                - Bola menyentuh tanah ketika $$h(t) = 0$$

                ### Contoh: Keuntungan Maksimum

                Sebuah toko memiliki fungsi keuntungan:
                $$P(x) = -2x^2 + 80x - 600$$

                dimana $$x$$ adalah jumlah barang yang dijual.

                **Analisis:**
                - Penjualan optimal: $$x = -\frac{80}{2(-2)} = 20$$ unit
                - Keuntungan maksimum: $$P(20) = 200$$ ribu rupiah
                ',
                'math_symbols' => json_encode([
                    'x^2' => 'x²',
                    'sqrt' => '√',
                    'pm' => '±',
                    'times' => '×',
                    'div' => '÷'
                ]),
                'references' => json_encode([
                    'Teknik Menggambar Grafik Fungsi - Panduan Praktis',
                    'Aplikasi Fungsi Kuadrat dalam Fisika',
                    'Optimisasi dengan Fungsi Kuadrat - Ekonomi Matematika'
                ]),
                'order' => 3,
                'min_score' => 80,
                'is_published' => true
            ],

            // 4. Evaluasi
            [
                'title' => 'Menyelesaikan Masalah dengan Fungsi Kuadrat',
                'slug' => Str::slug('Menyelesaikan Masalah dengan Fungsi Kuadrat'),
                'type' => 'evaluasi',
                'description' => 'Menerapkan konsep fungsi kuadrat untuk menyelesaikan berbagai masalah kontekstual',
                'content' => '
                # Menyelesaikan Masalah dengan Fungsi Kuadrat

                Fungsi kuadrat memiliki banyak aplikasi dalam menyelesaikan masalah-masalah praktis. Pada bagian ini, kita akan mempelajari berbagai teknik untuk menyelesaikan masalah menggunakan fungsi kuadrat.

                ## Metode Penyelesaian Persamaan Kuadrat

                Terdapat beberapa metode untuk menyelesaikan persamaan kuadrat $$ax^2 + bx + c = 0$$:

                ### 1. Metode Faktorisasi

                Jika persamaan dapat difaktorkan menjadi $$(px + q)(rx + s) = 0$$, maka solusinya adalah:
                $$x = -\frac{q}{p}$$ atau $$x = -\frac{s}{r}$$

                **Contoh:** $$x^2 - 5x + 6 = 0$$
                $$(x - 2)(x - 3) = 0$$
                Jadi $$x = 2$$ atau $$x = 3$$

                ### 2. Melengkapkan Kuadrat

                Mengubah persamaan ke bentuk $$(x + p)^2 = q$$

                **Contoh:** $$x^2 + 6x - 7 = 0$$
                $$x^2 + 6x = 7$$
                $$x^2 + 6x + 9 = 7 + 9$$
                $$(x + 3)^2 = 16$$
                $$x + 3 = \pm 4$$
                $$x = -3 \pm 4$$

                Jadi $$x = 1$$ atau $$x = -7$$

                ### 3. Rumus ABC (Rumus Kuadrat)

                Untuk persamaan $$ax^2 + bx + c = 0$$:

                $$x = \frac{-b \pm \sqrt{b^2 - 4ac}}{2a}$$

                **Contoh:** $$2x^2 + 3x - 2 = 0$$
                $$x = \frac{-3 \pm \sqrt{9 - 4(2)(-2)}}{2(2)} = \frac{-3 \pm \sqrt{25}}{4} = \frac{-3 \pm 5}{4}$$

                Jadi $$x = \frac{1}{2}$$ atau $$x = -2$$

                ## Masalah Optimisasi

                Fungsi kuadrat sering digunakan untuk mencari nilai maksimum atau minimum.

                ### Contoh: Penghematan Bahan Bakar

                Berdasarkan penelitian, hubungan antara penghematan bahan bakar $$P(x)$$ (km/liter) dengan kelajuan mobil $$x$$ (km/jam) dinyatakan dengan:

                $$P(x) = -0.00133x^2 + 0.1938x + 5.8$$

                **Pertanyaan:** Pada kelajuan berapa penghematan bahan bakar maksimum?

                **Penyelesaian:**
                Kelajuan optimal: $$x = -\frac{0.1938}{2(-0.00133)} \approx 72.8$$ km/jam

                Penghematan maksimum: $$P(72.8) \approx 12.9$$ km/liter

                ### Contoh: Luas Maksimum

                Seorang petani memiliki kawat sepanjang 120 meter untuk membuat pagar berbentuk persegi panjang. Berapakah dimensi pagar agar luasnya maksimum?

                **Penyelesaian:**
                Misalkan panjang = $$x$$ dan lebar = $$y$$
                Keliling: $$2x + 2y = 120$$ → $$y = 60 - x$$
                Luas: $$L(x) = xy = x(60 - x) = 60x - x^2$$

                Untuk luas maksimum: $$x = -\frac{60}{2(-1)} = 30$$ meter
                Jadi $$y = 30$$ meter

                Luas maksimum = $$30 \times 30 = 900$$ meter²

                ## Masalah Gerak Projektil

                ### Contoh: Lintasan Peluru

                Sebuah peluru ditembakkan dengan lintasan:
                $$h(t) = -4.9t^2 + 49t + 10$$

                dimana $$h(t)$$ adalah ketinggian (meter) setelah $$t$$ detik.

                **Analisis:**
                1. **Ketinggian maksimum:**
                   $$t = -\frac{49}{2(-4.9)} = 5$$ detik
                   $$h(5) = 132.5$$ meter

                2. **Kapan peluru menyentuh tanah?**
                   $$-4.9t^2 + 49t + 10 = 0$$
                   Menggunakan rumus ABC: $$t \approx 10.2$$ detik

                ## Tips Menyelesaikan Masalah

                1. **Identifikasi variabel** yang akan dimaksimalkan/diminimalkan
                2. **Buat model matematika** dalam bentuk fungsi kuadrat
                3. **Tentukan domain** yang masuk akal untuk masalah tersebut
                4. **Gunakan sifat-sifat fungsi kuadrat** untuk menentukan nilai optimum
                5. **Interpretasikan hasil** dalam konteks masalah asli
                ',
                'math_symbols' => json_encode([
                    'x^2' => 'x²',
                    'sqrt' => '√',
                    'pm' => '±',
                    'times' => '×',
                    'div' => '÷',
                    'approx' => '≈'
                ]),
                'references' => json_encode([
                    'Problem Solving dengan Fungsi Kuadrat - Advanced Mathematics',
                    'Optimisasi dalam Kehidupan Sehari-hari - Applied Math Journal',
                    'Fisika dan Matematika: Gerak Projektil'
                ]),
                'order' => 4,
                'min_score' => 85,
                'is_published' => true
            ]
        ];

        foreach ($materials as $materialData) {
            LearningMaterial::create($materialData);
        }
    }
}