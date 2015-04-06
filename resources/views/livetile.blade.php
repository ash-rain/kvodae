<tile>
  <visual>
    <binding template="TileSquarePeekImageAndText01">
      <image id="1" src="image1" alt="alt text"/>
      <text id="1">Text Field 1 (larger text)</text>
      <text id="2">Text Field 2</text>
      <text id="3">Text Field 3</text>
      <text id="4">Text Field 4</text>
    </binding>  
  </visual>
</tile>

<tile>
  <visual version="2">
    <binding template="TileSquare150x150PeekImageAndText01" fallback="TileSquarePeekImageAndText01">
      <image id="1" src="image1" alt="alt text"/>
      <text id="1">Text Field 1 (larger text)</text>
      <text id="2">Text Field 2</text>
      <text id="3">Text Field 3</text>
      <text id="4">Text Field 4</text>
    </binding>  
  </visual>
</tile>