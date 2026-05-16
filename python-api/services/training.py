import os
import json
import joblib
import pandas as pd

from sklearn.feature_extraction.text import TfidfVectorizer

from sklearn.naive_bayes import MultinomialNB

from sklearn.svm import LinearSVC

from sklearn.model_selection import (
    train_test_split
)

from sklearn.metrics import (

    accuracy_score,

    precision_score,

    recall_score,

    f1_score

)

# =========================
# LOAD DATASET
# =========================
xlsx_path = 'dataset/dataset.xlsx'

xls_path = 'dataset/dataset.xls'

csv_path = 'dataset/dataset.csv'

# =========================
# CEK FILE
# =========================
if os.path.exists(xlsx_path):

    print('📄 Membaca dataset.xlsx')

    df = pd.read_excel(xlsx_path)

elif os.path.exists(xls_path):

    print('📄 Membaca dataset.xls')

    df = pd.read_excel(xls_path)

elif os.path.exists(csv_path):

    print('📄 Membaca dataset.csv')

    df = pd.read_csv(csv_path)

else:

    raise FileNotFoundError(
        'Dataset tidak ditemukan'
    )

# =========================
# RAPIIKAN HEADER
# =========================
df.columns = df.columns.str.strip()

# =========================
# HAPUS DATA NULL
# =========================
df = df.dropna(
    subset=['content', 'labelling']
)

# =========================
# DATA
# =========================
X = df['content'].astype(str)

y = df['labelling'].astype(str)

# =========================
# SPLIT DATA
# =========================
X_train, X_test, y_train, y_test = train_test_split(

    X,

    y,

    test_size=0.2,

    random_state=42

)

# =========================
# TF-IDF
# =========================
vectorizer = TfidfVectorizer()

X_train_vector = vectorizer.fit_transform(
    X_train
)

X_test_vector = vectorizer.transform(
    X_test
)

# =========================
# NAIVE BAYES
# =========================
print('🚀 Training Naive Bayes...')

nb_model = MultinomialNB()

nb_model.fit(
    X_train_vector,
    y_train
)

nb_prediction = nb_model.predict(
    X_test_vector
)

# =========================
# METRIK NB
# =========================
nb_accuracy = accuracy_score(
    y_test,
    nb_prediction
)

nb_precision = precision_score(
    y_test,
    nb_prediction,
    average='weighted'
)

nb_recall = recall_score(
    y_test,
    nb_prediction,
    average='weighted'
)

nb_f1 = f1_score(
    y_test,
    nb_prediction,
    average='weighted'
)

# =========================
# SVM
# =========================
print('🚀 Training SVM...')

svm_model = LinearSVC()

svm_model.fit(
    X_train_vector,
    y_train
)

svm_prediction = svm_model.predict(
    X_test_vector
)

# =========================
# METRIK SVM
# =========================
svm_accuracy = accuracy_score(
    y_test,
    svm_prediction
)

svm_precision = precision_score(
    y_test,
    svm_prediction,
    average='weighted'
)

svm_recall = recall_score(
    y_test,
    svm_prediction,
    average='weighted'
)

svm_f1 = f1_score(
    y_test,
    svm_prediction,
    average='weighted'
)

# =========================
# BUAT FOLDER MODEL
# =========================
if not os.path.exists('models'):

    os.makedirs('models')

# =========================
# SIMPAN MODEL
# =========================
joblib.dump(
    nb_model,
    'models/nb_model.pkl'
)

joblib.dump(
    svm_model,
    'models/svm_model.pkl'
)

joblib.dump(
    vectorizer,
    'models/vectorizer.pkl'
)

# =========================
# SIMPAN HASIL EVALUASI
# =========================
accuracy = {

    'naive_bayes': {

        'accuracy':
            round(nb_accuracy * 100, 2),

        'precision':
            round(nb_precision * 100, 2),

        'recall':
            round(nb_recall * 100, 2),

        'f1_score':
            round(nb_f1 * 100, 2)

    },

    'svm': {

        'accuracy':
            round(svm_accuracy * 100, 2),

        'precision':
            round(svm_precision * 100, 2),

        'recall':
            round(svm_recall * 100, 2),

        'f1_score':
            round(svm_f1 * 100, 2)

    }

}

with open(
    'models/accuracy.json',
    'w'
) as f:

    json.dump(
        accuracy,
        f
    )

print(accuracy)

print('✅ Training selesai')
