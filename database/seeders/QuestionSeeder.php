<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\LearningMaterial;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        // Get learning materials
        $pendahuluan = LearningMaterial::where('type', 'pendahuluan')->first();
        $materi = LearningMaterial::where('type', 'materi')->first();
        $latihan = LearningMaterial::where('type', 'latihan')->first();
        $evaluasi = LearningMaterial::where('type', 'evaluasi')->first();

        $questions = [
            // PENDAHULUAN - Multiple Choice Questions
            [
                'learning_material_id' => $pendahuluan->id,
                'type' => 'multiple_choice',
                'question_text' => 'Bentuk umum fungsi kuadrat adalah...',
                'points' => 10,
                'order' => 1,
                'explanation' => 'Bentuk umum fungsi kuadrat adalah f(x) = ax² + bx + c dimana a ≠ 0, a adalah koefisien dari x², b adalah koefisien dari x, dan c adalah konstanta.',
                'is_active' => true,
                'options' => [
                    'A' => 'f(x) = ax + b',
                    'B' => 'f(x) = ax² + bx + c',
                    'C' => 'f(x) = ax³ + bx² + cx + d',
                    'D' => 'f(x) = a/x + b',
                    'E' => 'f(x) = a√x + b'
                ],
                'correct_option' => 'B'
            ],
            [
                'learning_material_id' => $pendahuluan->id,
                'type' => 'multiple_choice',
                'question_text' => 'Syarat agar f(x) = ax² + bx + c disebut fungsi kuadrat adalah...',
                'points' => 10,
                'order' => 2,
                'explanation' => 'Untuk menjadi fungsi kuadrat, koefisien a harus tidak sama dengan nol (a ≠ 0) karena jika a = 0, maka fungsi tersebut menjadi fungsi linear.',
                'is_active' => true,
                'options' => [
                    'A' => 'a = 0',
                    'B' => 'a ≠ 0',
                    'C' => 'b = 0',
                    'D' => 'c = 0',
                    'E' => 'a = b = c'
                ],
                'correct_option' => 'B'
            ],
            [
                'learning_material_id' => $pendahuluan->id,
                'type' => 'free_text',
                'question_text' => 'Sebutkan 3 contoh penerapan fungsi kuadrat dalam kehidupan sehari-hari!',
                'correct_answer' => 'Contoh penerapan fungsi kuadrat dalam kehidupan sehari-hari: 1) Lintasan bola yang dilempar ke udara membentuk parabola, 2) Bentuk antena parabola mengikuti fungsi kuadrat, 3) Struktur kabel jembatan gantung membentuk kurva parabola, 4) Gerak proyektil dalam fisika, 5) Optimisasi keuntungan dalam ekonomi.',
                'points' => 15,
                'order' => 3,
                'explanation' => 'Fungsi kuadrat banyak dijumpai dalam fenomena alam dan teknologi karena bentuk parabolanya yang efisien untuk berbagai keperluan.',
                'is_active' => true
            ],

            // MATERI - Multiple Choice Questions
            [
                'learning_material_id' => $materi->id,
                'type' => 'multiple_choice',
                'question_text' => 'Jika fungsi kuadrat f(x) = 2x² - 4x + 1, maka koordinat titik puncaknya adalah...',
                'points' => 15,
                'order' => 1,
                'explanation' => 'Sumbu simetri: x = -b/2a = -(-4)/2(2) = 1. Titik puncak: (1, f(1)) = (1, 2(1)² - 4(1) + 1) = (1, -1).',
                'is_active' => true,
                'options' => [
                    'A' => '(1, -1)',
                    'B' => '(-1, 1)',
                    'C' => '(2, -3)',
                    'D' => '(-2, 3)',
                    'E' => '(0, 1)'
                ],
                'correct_option' => 'A'
            ],
            [
                'learning_material_id' => $materi->id,
                'type' => 'multiple_choice',
                'question_text' => 'Parabola y = -3x² + 6x - 2 terbuka ke...',
                'points' => 10,
                'order' => 2,
                'explanation' => 'Karena koefisien a = -3 < 0, maka parabola terbuka ke bawah dan memiliki titik maksimum.',
                'is_active' => true,
                'options' => [
                    'A' => 'atas dan memiliki titik minimum',
                    'B' => 'bawah dan memiliki titik maksimum',
                    'C' => 'atas dan memiliki titik maksimum',
                    'D' => 'bawah dan memiliki titik minimum',
                    'E' => 'samping'
                ],
                'correct_option' => 'B'
            ],
            [
                'learning_material_id' => $materi->id,
                'type' => 'multiple_choice',
                'question_text' => 'Diskriminan dari persamaan x² - 6x + 9 = 0 adalah...',
                'points' => 15,
                'order' => 3,
                'explanation' => 'D = b² - 4ac = (-6)² - 4(1)(9) = 36 - 36 = 0. Karena D = 0, persamaan memiliki satu akar kembar.',
                'is_active' => true,
                'options' => [
                    'A' => '-36',
                    'B' => '0',
                    'C' => '36',
                    'D' => '72',
                    'E' => '18'
                ],
                'correct_option' => 'B'
            ],
            [
                'learning_material_id' => $materi->id,
                'type' => 'free_text',
                'question_text' => 'Tentukan sumbu simetri dari fungsi f(x) = x² - 8x + 12 dan jelaskan artinya!',
                'correct_answer' => 'Sumbu simetri: x = -b/2a = -(-8)/2(1) = 4. Artinya: garis x = 4 adalah garis vertikal yang membagi parabola menjadi dua bagian yang sama (simetris), dan titik puncak parabola terletak pada garis ini.',
                'points' => 20,
                'order' => 4,
                'explanation' => 'Sumbu simetri adalah garis yang membagi parabola menjadi dua bagian yang identik dan saling bercermin.',
                'is_active' => true
            ],

            // LATIHAN - Mixed Questions
            [
                'learning_material_id' => $latihan->id,
                'type' => 'multiple_choice',
                'question_text' => 'Sebuah bola dilempar ke atas dengan ketinggian h(t) = -5t² + 20t + 2 (dalam meter). Ketinggian maksimum bola adalah...',
                'points' => 20,
                'order' => 1,
                'explanation' => 'Waktu mencapai ketinggian maksimum: t = -b/2a = -20/2(-5) = 2 detik. Ketinggian maksimum: h(2) = -5(4) + 20(2) + 2 = -20 + 40 + 2 = 22 meter.',
                'is_active' => true,
                'options' => [
                    'A' => '20 meter',
                    'B' => '22 meter',
                    'C' => '25 meter',
                    'D' => '18 meter',
                    'E' => '24 meter'
                ],
                'correct_option' => 'B'
            ],
            [
                'learning_material_id' => $latihan->id,
                'type' => 'multiple_choice',
                'question_text' => 'Akar-akar persamaan x² - 7x + 12 = 0 adalah...',
                'points' => 15,
                'order' => 2,
                'explanation' => 'x² - 7x + 12 = 0 dapat difaktorkan menjadi (x - 3)(x - 4) = 0, sehingga x = 3 atau x = 4.',
                'is_active' => true,
                'options' => [
                    'A' => 'x = 2 dan x = 5',
                    'B' => 'x = 3 dan x = 4',
                    'C' => 'x = 1 dan x = 6',
                    'D' => 'x = -3 dan x = -4',
                    'E' => 'x = 0 dan x = 7'
                ],
                'correct_option' => 'B'
            ],
            [
                'learning_material_id' => $latihan->id,
                'type' => 'free_text',
                'question_text' => 'Gambar sketsa grafik fungsi f(x) = x² - 4x + 3 dan tentukan titik potongnya dengan sumbu koordinat!',
                'correct_answer' => 'Sketsa grafik: Parabola terbuka ke atas (a = 1 > 0). Titik potong sumbu y: (0, 3). Titik potong sumbu x: dapat dicari dari x² - 4x + 3 = 0, yaitu (x-1)(x-3) = 0, sehingga x = 1 dan x = 3. Titik potong sumbu x: (1, 0) dan (3, 0). Titik puncak: x = 2, f(2) = -1, jadi (2, -1).',
                'points' => 25,
                'order' => 3,
                'explanation' => 'Untuk menggambar grafik fungsi kuadrat, perlu menentukan karakteristik utama seperti arah bukaan, titik puncak, dan titik potong.',
                'is_active' => true
            ],
            [
                'learning_material_id' => $latihan->id,
                'type' => 'free_text',
                'question_text' => 'Sebuah toko memiliki fungsi keuntungan P(x) = -2x² + 80x - 600 (dalam ribuan rupiah), dimana x adalah jumlah barang terjual. Tentukan penjualan optimal dan keuntungan maksimumnya!',
                'correct_answer' => 'Penjualan optimal: x = -b/2a = -80/2(-2) = 20 unit. Keuntungan maksimum: P(20) = -2(400) + 80(20) - 600 = -800 + 1600 - 600 = 200 ribu rupiah. Jadi penjualan optimal adalah 20 unit dengan keuntungan maksimum 200 ribu rupiah.',
                'points' => 30,
                'order' => 4,
                'explanation' => 'Masalah optimisasi menggunakan sifat titik puncak parabola untuk mencari nilai maksimum atau minimum.',
                'is_active' => true
            ],

            // EVALUASI - Advanced Questions
            [
                'learning_material_id' => $evaluasi->id,
                'type' => 'multiple_choice',
                'question_text' => 'Jika α dan β adalah akar-akar persamaan 2x² - 6x + 3 = 0, maka nilai α + β adalah...',
                'points' => 20,
                'order' => 1,
                'explanation' => 'Untuk persamaan ax² + bx + c = 0, jumlah akar α + β = -b/a = -(-6)/2 = 3.',
                'is_active' => true,
                'options' => [
                    'A' => '2',
                    'B' => '3',
                    'C' => '6',
                    'D' => '-3',
                    'E' => '1.5'
                ],
                'correct_option' => 'B'
            ],
            [
                'learning_material_id' => $evaluasi->id,
                'type' => 'multiple_choice',
                'question_text' => 'Agar persamaan kuadrat x² - 2kx + (k² - 1) = 0 mempunyai akar kembar, maka nilai k adalah...',
                'points' => 25,
                'order' => 2,
                'explanation' => 'Untuk akar kembar, diskriminan D = 0. D = (-2k)² - 4(1)(k² - 1) = 4k² - 4k² + 4 = 4. Karena D selalu 4 > 0, tidak ada nilai k yang membuat akar kembar. Namun jika soal dimaksudkan untuk D = 0, maka tidak ada solusi. Periksa kembali soal.',
                'is_active' => true,
                'options' => [
                    'A' => 'k = 1',
                    'B' => 'k = -1',
                    'C' => 'k = 0',
                    'D' => 'k = 2',
                    'E' => 'Tidak ada nilai k'
                ],
                'correct_option' => 'E'
            ],
            [
                'learning_material_id' => $evaluasi->id,
                'type' => 'free_text',
                'question_text' => 'Selesaikan persamaan x² + 6x - 7 = 0 menggunakan tiga metode yang berbeda!',
                'correct_answer' => 'Metode 1 (Faktorisasi): x² + 6x - 7 = 0 → (x + 7)(x - 1) = 0 → x = -7 atau x = 1. Metode 2 (Melengkapkan kuadrat): x² + 6x = 7 → x² + 6x + 9 = 16 → (x + 3)² = 16 → x + 3 = ±4 → x = 1 atau x = -7. Metode 3 (Rumus ABC): x = (-6 ± √(36 + 28))/2 = (-6 ± √64)/2 = (-6 ± 8)/2, sehingga x = 1 atau x = -7.',
                'points' => 30,
                'order' => 3,
                'explanation' => 'Tiga metode penyelesaian persamaan kuadrat memberikan hasil yang sama, dapat dipilih sesuai dengan kemudahan perhitungan.',
                'is_active' => true
            ],
            [
                'learning_material_id' => $evaluasi->id,
                'type' => 'free_text',
                'question_text' => 'Sebuah peluru ditembakkan dengan lintasan h(t) = -4.9t² + 49t + 1.5. Tentukan: a) waktu peluru mencapai ketinggian maksimum, b) ketinggian maksimum, c) kapan peluru menyentuh tanah!',
                'correct_answer' => 'a) Waktu ketinggian maksimum: t = -b/2a = -49/2(-4.9) = 5 detik. b) Ketinggian maksimum: h(5) = -4.9(25) + 49(5) + 1.5 = -122.5 + 245 + 1.5 = 124 meter. c) Peluru menyentuh tanah saat h(t) = 0: -4.9t² + 49t + 1.5 = 0. Menggunakan rumus ABC: t = (-49 ± √(2401 + 29.4))/(-9.8) ≈ (-49 ± 49.3)/(-9.8). Mengambil nilai positif: t ≈ 10.03 detik.',
                'points' => 35,
                'order' => 4,
                'explanation' => 'Masalah gerak proyektil adalah aplikasi klasik fungsi kuadrat dalam fisika, dimana tinggi maksimum dicapai di titik puncak parabola.',
                'is_active' => true
            ],
            [
                'learning_material_id' => $evaluasi->id,
                'type' => 'free_text',
                'question_text' => 'Seorang arsitek ingin membuat jendela berbentuk setengah lingkaran di atas persegi panjang. Jika keliling total 20 meter, tentukan dimensi yang memberikan luas maksimum!',
                'correct_answer' => 'Misalkan lebar persegi panjang = 2r (diameter setengah lingkaran) dan tinggi = h. Keliling total: 2r + 2h + πr = 20. Sehingga h = (20 - 2r - πr)/2 = 10 - r - πr/2. Luas total: L = luas persegi panjang + luas setengah lingkaran = 2rh + πr²/2 = 2r(10 - r - πr/2) + πr²/2 = 20r - 2r² - πr² + πr²/2 = 20r - 2r² - πr²/2. Untuk luas maksimum: dL/dr = 20 - 4r - πr = 0, sehingga r = 20/(4 + π) ≈ 2.8 meter. h = 10 - 2.8 - π(2.8)/2 ≈ 2.8 meter.',
                'points' => 40,
                'order' => 5,
                'explanation' => 'Masalah optimisasi gabungan memerlukan pemahaman geometri dan kalkulus untuk mendapatkan fungsi kuadrat yang tepat.',
                'is_active' => true
            ]
        ];

        foreach ($questions as $questionData) {
            $options = $questionData['options'] ?? null;
            $correctOption = $questionData['correct_option'] ?? null;
            
            // Remove options from question data
            unset($questionData['options'], $questionData['correct_option']);
            
            $question = Question::create($questionData);
            
            // Create options for multiple choice questions
            if ($question->type === 'multiple_choice' && $options) {
                foreach ($options as $letter => $optionText) {
                    QuestionOption::create([
                        'question_id' => $question->id,
                        'option_letter' => $letter,
                        'option_text' => $optionText,
                        'is_correct' => $letter === $correctOption
                    ]);
                }
            }
        }
    }
}