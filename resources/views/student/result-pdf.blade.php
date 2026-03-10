<h2>Online Exam System</h2>

<hr>

<p><strong>Name:</strong> {{ $student->name }}</p>
<p><strong>Exam:</strong> {{ $attempt->exam->title }}</p>
<p><strong>Date:</strong> {{ $attempt->created_at->format('d M Y') }}</p>

<hr>

<table border="1" cellpadding="10" cellspacing="0" width="100%">
<tr>
<th>Total Questions</th>
<th>Correct</th>
<th>Wrong</th>
<th>Score</th>
<th>Percentage</th>
<th>Status</th>
</tr>

<tr>
<td>{{ $totalQuestions }}</td>
<td>{{ $correctAnswers }}</td>
<td>{{ $wrongAnswers }}</td>
<td>{{ $attempt->score }}</td>
<td>{{ $attempt->percentage }}%</td>
<td>{{ strtoupper($attempt->status) }}</td>
</tr>

</table>