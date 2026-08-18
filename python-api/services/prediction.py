import os
import joblib

from services.preprocessing import (
    preprocess_text
)

# =========================
# LOAD MODEL
# Sekarang setiap file adalah PIPELINE UTUH
# (tfidf + classifier), hasil dari
# grid_nb.best_estimator_ / grid_svm.best_estimator_
# yang disimpan di train.py.
# =========================
nb_model = None

svm_model = None

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
# PREDICT NB
# =========================
def predict_nb(text):

    if nb_model is None:

        return 'Model NB belum ditraining'

    text = preprocess_text(text)

    prediction = nb_model.predict(
        [text]
    )[0]

    return prediction

# =========================
# PREDICT SVM
# =========================
def predict_svm(text):

    if svm_model is None:

        return 'Model SVM belum ditraining'

    text = preprocess_text(text)

    prediction = svm_model.predict(
        [text]
    )[0]

    return prediction
