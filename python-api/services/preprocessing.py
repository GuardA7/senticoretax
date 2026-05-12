import re

from nltk.corpus import stopwords

from Sastrawi.Stemmer.StemmerFactory import (
    StemmerFactory
)

# =========================
# STOPWORD
# =========================
stop_words = set(
    stopwords.words('indonesian')
)

# =========================
# STEMMER
# =========================
factory = StemmerFactory()

stemmer = factory.create_stemmer()

# =========================
# PREPROCESS DETAIL
# =========================
def preprocess_detail(text):

    # =========================
    # ORIGINAL
    # =========================
    original = str(text)

    # =========================
    # CASE FOLDING
    # =========================
    casefold = original.lower()

    # =========================
    # CLEANING
    # =========================
    cleaning = re.sub(
        r'[^a-zA-Z\s]',
        '',
        casefold
    )

    # =========================
    # TOKENIZING
    # =========================
    tokens = cleaning.split()

    # =========================
    # STOPWORD
    # =========================
    stopword = [
        word for word in tokens
        if word not in stop_words
    ]

    # =========================
    # STEMMING
    # =========================
    stemming = [
        stemmer.stem(word)
        for word in stopword
    ]

    # =========================
    # FINAL
    # =========================
    final = ' '.join(stemming)

    return {

        'original': original,

        'casefolding': casefold,

        'cleaning': cleaning,

        'tokenizing': tokens,

        'stopword': stopword,

        'stemming': stemming,

        'final': final

    }

# =========================
# SIMPLE PREPROCESS
# =========================
def preprocess_text(text):

    result =preprocess_detail(text)

    return result['final']
