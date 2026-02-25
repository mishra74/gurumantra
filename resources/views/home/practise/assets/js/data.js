let questions = [];   // empty initially
function fetchQuestions(tileId) {
    fetch(`/admin/get-question/${tileId}`)
        .then(response => response.json())
        .then(res => {

            if (!res.status) {
                alert(res.message);
                return;
            }

            // Convert backend format into your frontend format
            questions = res.data.map(q => ({
                question: {
                    english: q.question_english,
                    hindi: q.question_hindi
                },
                options: {
                    english: [
                        q.option1_english,
                        q.option2_english,
                        q.option3_english,
                        q.option4_english
                    ],
                    hindi: [
                        q.option1_hindi,
                        q.option2_hindi,
                        q.option3_hindi,
                        q.option4_hindi
                    ]
                },
                correct: q.correct_answer_index
            }));

            // Reset tracking arrays
            userAnswers = new Array(questions.length).fill(null);
            reviewMarked = new Array(questions.length).fill(false);
            saveAndReview = new Array(questions.length).fill(false);
            visited = new Array(questions.length).fill(false);

            createPalette();
            loadQuestion(0);
        })
        .catch(err => {
            console.error("Error fetching questions:", err);
        });
}

