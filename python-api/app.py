from flask import (
    Flask,
    request,
    jsonify
)

from services.preprocessing import (
    preprocess_detail
)

from services.prediction import (
    predict_nb,
    predict_svm
)

app = Flask(__name__)

# =========================
# PREPROCESSING
# =========================
@app.route(
    '/preprocessing',
    methods=['POST']
)
def preprocessing():

    data = request.get_json()

    text = data['text']

    result = preprocess_detail(text)

    return jsonify(result)

# =========================
# NAIVE BAYES
# =========================
@app.route(
    '/predict/nb',
    methods=['POST']
)
def predict_naive_bayes():

    data = request.get_json()

    text = data['content']

    result = predict_nb(text)

    return jsonify({
        'result': result
    })

# =========================
# SVM
# =========================
@app.route(
    '/predict/svm',
    methods=['POST']
)
def predict_support_vector_machine():

    data = request.get_json()

    text = data['content']

    result = predict_svm(text)

    return jsonify({
        'result': result
    })

# =========================
# RUN
# =========================
if __name__ == '__main__':

    print("🚀 Flask API Running")

    app.run(
        debug=True
    )
