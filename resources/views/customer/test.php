TEST
<hr>
<a href="/product/1/2-3_3-5">Product 1</a><br>
<a href="/product/2/2-4_3-6">Product 2</a><br>
<a href="/product/3/2-3_3-6">Product 3</a>


<form action="/product/1" method="get">
    <input type="hidden" name="initial_selection_string" value="2-3_3-5">
    <button type="submit">Product 1</button>
</form>

<form action="/product/2" method="get">
    <input type="hidden" name="initial_selection_string" value="2-4_3-6">
    <button type="submit">Product 2</button>
</form>

<form action="/product/2" method="get">
    <input type="hidden" name="initial_selection_string" value="2-3_3-6">
    <button type="submit">Product 3</button>
</form>