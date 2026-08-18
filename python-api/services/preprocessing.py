import re

from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
from Sastrawi.StopWordRemover.StopWordRemoverFactory import StopWordRemoverFactory

# =========================
# INIT STEMMER (SASTRAWI)
# =========================
stemmer_factory = StemmerFactory()
stemmer = stemmer_factory.create_stemmer()

# =========================
# STOPWORD DASAR (SASTRAWI)
# =========================
stopword_factory = StopWordRemoverFactory()
default_stopwords = set(stopword_factory.get_stop_words())

# =========================
# KATA YANG WAJIB DIPERTAHANKAN
# Kata negasi, pembanding, dan penunjuk waktu ini
# SANGAT MENENTUKAN POLARITAS SENTIMEN.
# Kalau ikut terbuang sebagai stopword, kalimat
# seperti "aplikasinya bagusan dulu" atau
# "tidak bagus" bisa salah diklasifikasikan
# karena makna pembanding/negasinya hilang.
# =========================
KEEP_WORDS = {

    # =========================
    # NEGASI
    # =========================
    'tidak', 'tak', 'bukan', 'jangan', 'belum',
    'nggak', 'gak', 'ga', 'kagak', 'tanpa',

    # =========================
    # PEMBANDING / TEMPORAL
    # (penting untuk konteks "dulu vs sekarang")
    # =========================
    'dulu', 'sekarang', 'lebih', 'kurang',
    'daripada', 'dibanding', 'dibandingkan',
    'makin', 'semakin', 'tambah',

    # =========================
    # PENGUAT/PELEMAH MAKNA
    # =========================
    'sangat', 'terlalu', 'banget', 'sekali',
    'agak', 'sedikit',

}

# =========================
# STOPWORD FINAL
# (default dikurangi kata yang wajib dipertahankan)
# =========================
custom_stopwords = default_stopwords - KEEP_WORDS


# =========================
# CLEANING
# =========================
def clean_text(text: str) -> str:

    text = text.lower()

    # hapus url
    text = re.sub(r'http\S+|www\S+', ' ', text)

    # hapus mention & hashtag
    text = re.sub(r'@\w+|#\w+', ' ', text)

    # hapus angka
    text = re.sub(r'\d+', ' ', text)

    # hapus tanda baca & karakter selain huruf/spasi
    text = re.sub(r'[^a-z\s]', ' ', text)

    # rapikan spasi berlebih
    text = re.sub(r'\s+', ' ', text).strip()

    return text


# =========================
# TOKENIZING
# =========================
def tokenize_text(text: str) -> list:

    if not text:
        return []

    return text.split(' ')


# =========================
# STOPWORD REMOVAL
# =========================
def remove_stopwords(tokens: list) -> list:

    return [
        token for token in tokens
        if token not in custom_stopwords
        and token != ''
    ]


# =========================
# STEMMING
# =========================
def stem_tokens(tokens: list) -> list:

    return [
        stemmer.stem(token)
        for token in tokens
    ]


# =========================
# PIPELINE UTAMA
# =========================
def preprocess_detail(text: str) -> dict:

    # =========================
    # 1. CLEANING
    # =========================
    cleaning_result = clean_text(text)

    # =========================
    # 2. TOKENIZING
    # =========================
    tokenizing_result = tokenize_text(cleaning_result)

    # =========================
    # 3. STOPWORD REMOVAL
    # =========================
    stopword_result = remove_stopwords(tokenizing_result)

    # =========================
    # 4. STEMMING
    # =========================
    stemming_result = stem_tokens(stopword_result)

    # =========================
    # 5. FINAL (gabungan hasil akhir)
    # =========================
    final_result = ' '.join(stemming_result)

    return {

        'cleaning': cleaning_result,

        'tokenizing': tokenizing_result,

        'stopword': stopword_result,

        'stemming': stemming_result,

        'final': final_result,

    }


# =========================
# WRAPPER UNTUK PREDIKSI
# Dipakai oleh services/prediction.py — hanya butuh
# string hasil akhir preprocessing, bukan breakdown
# per-tahap seperti preprocess_detail().
# =========================
def preprocess_text(text: str) -> str:

    result = preprocess_detail(text)

    return result['final']
