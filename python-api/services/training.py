import pandas as pd

import joblib

from sklearn.pipeline import Pipeline

from sklearn.feature_extraction.text import (
    TfidfVectorizer
)

from sklearn.naive_bayes import (
    MultinomialNB
)

from sklearn.svm import (
    LinearSVC
)

from sklearn.model_selection import (
    train_test_split
)

from sklearn.metrics import (
    accuracy_score
)

from preprocessing import preprocess_text

# =========================
# LOAD DATASET
# =========================
print("📖 Membaca dataset...")

df = pd.read_csv(
    '../dataset/dataset.csv'
)

# =========================
# CEK KOLOM
# =========================
print(df.columns)

# =========================
# HAPUS DATA KOSONG
# =========================
df = df.dropna(
    subset=['content', 'labelling']
)

# =========================
# NORMALISASI LABEL
# =========================
df['labelling'] = df[
    'labelling'
].astype(str)

df['labelling'] = df[
    'labelling'
].str.lower()

df['labelling'] = df[
    'labelling'
].str.strip()

df['labelling'] = df[
    'labelling'
].str.replace('.', '')

df['labelling'] = df[
    'labelling'
].str.replace(',', '')

# =========================
# FILTER LABEL VALID
# =========================
valid_labels = [
    'positif',
    'negatif',
    'netral'
]

df = df[
    df['labelling'].isin(valid_labels)
]

print(
    "Jumlah data:",
    len(df)
)

# =========================
# PREPROCESSING
# =========================
print("🧹 Preprocessing teks...")

df['processed'] = df[
    'content'
].astype(str).apply(
    preprocess_text
)

# =========================
# FEATURE & LABEL
# =========================
X = df['processed']

y = df['labelling']

# =========================
# SPLIT DATA
# =========================
print("✂️ Split dataset...")

X_train, X_test, y_train, y_test = train_test_split(
    X,
    y,
    test_size=0.2,
    random_state=42,
    stratify=y
)

# =========================
# NAIVE BAYES
# =========================
print("🤖 Training Naive Bayes...")

nb_pipeline = Pipeline([
    (
        'tfidf',
        TfidfVectorizer(
            max_features=5000,
            ngram_range=(1,2),
            min_df=2,
            max_df=0.9
        )
    ),
    (
        'clf',
        MultinomialNB()
    )
])

nb_pipeline.fit(
    X_train,
    y_train
)

nb_pred = nb_pipeline.predict(
    X_test
)

nb_accuracy = accuracy_score(
    y_test,
    nb_pred
)

print(
    f'NB Accuracy: {nb_accuracy:.2%}'
)

joblib.dump(
    nb_pipeline,
    '../models/nb_model.pkl'
)

# =========================
# SVM
# =========================
print("🤖 Training SVM...")

svm_pipeline = Pipeline([
    (
        'tfidf',
        TfidfVectorizer(
            max_features=5000,
            ngram_range=(1,2),
            min_df=2,
            max_df=0.9
        )
    ),
    (
        'clf',
        LinearSVC()
    )
])

svm_pipeline.fit(
    X_train,
    y_train
)

svm_pred = svm_pipeline.predict(
    X_test
)

svm_accuracy = accuracy_score(
    y_test,
    svm_pred
)

print(
    f'SVM Accuracy: {svm_accuracy:.2%}'
)

joblib.dump(
    svm_pipeline,
    '../models/svm_model.pkl'
)

print("✅ Training selesai")
