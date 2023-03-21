<form action="/" method="POST">
@csrf
<label for="status">Status: </label>
<select name="status" id="status">
    <option value="published">published</option>
    <option value="archived">archived</option>
    <option value="created">created</option>
</select>
<button
    type="submit"
    class="h-10 w-20 text-white rounded-lg bg-blue-500 hover:bg-blue-600">
    OK
</button>
</form>