import joblib

from services.preprocessing import preprocess_text

nb_model = joblib.load(
    'models/nb_model.pkl'
)

svm_model = joblib.load(
    'models/svm_model.pkl'
)

# =========================
# PREDICT NB
# =========================
def predict_nb(text):

    processed = preprocess_text(text)

    prediction = nb_model.predict(
        [processed]
    )[0]

    probability = nb_model.predict_proba(
        [processed]
    )[0]

    confidence = round(
        max(probability) * 100,
        2
    )

    return {
        'prediction': prediction,
        'confidence': confidence,
        'processed': processed
    }

# =========================
# PREDICT SVM
# =========================
def predict_svm(text):

    processed = preprocess_text(text)

    prediction = svm_model.predict(
        [processed]
    )[0]

    return {
        'prediction': prediction,
        'confidence': 100,
        'processed': processed
    }
