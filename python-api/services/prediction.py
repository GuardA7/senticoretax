import os
import joblib

from services.preprocessing import (
    preprocess_text
)

# =========================
# LOAD MODEL
# =========================
nb_model = None

svm_model = None

vectorizer = None

# =========================
# LOAD NB
# =========================
if os.path.exists(
    'models/nb_model.pkl'
):

    nb_model = joblib.load(
        'models/nb_model.pkl'
    )

# =========================
# LOAD SVM
# =========================
if os.path.exists(
    'models/svm_model.pkl'
):

    svm_model = joblib.load(
        'models/svm_model.pkl'
    )

# =========================
# LOAD VECTORIZER
# =========================
if os.path.exists(
    'models/vectorizer.pkl'
):

    vectorizer = joblib.load(
        'models/vectorizer.pkl'
    )

# =========================
# PREDICT NB
# =========================
def predict_nb(text):

    if nb_model is None:

        return 'Model NB belum ditraining'

    text = preprocess_text(text)

    text_vector = vectorizer.transform(
        [text]
    )

    prediction = nb_model.predict(
            text_vector
        )[0]

    return prediction

# =========================
# PREDICT SVM
# =========================
def predict_svm(text):

    if svm_model is None:

        return 'Model SVM belum ditraining'

    text = preprocess_text(text)

    text_vector = vectorizer.transform(
        [text]
    )

    prediction = svm_model.predict(
            text_vector
        )[0]

    return prediction
