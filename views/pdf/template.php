<?php

  $data = $this->d;

  $profile = $data["profile"];
  $works = $data["works"];
  $educations = $data["educations"];
  $ability = $data["ability"];

  // print_r($data);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $profile["name"] . " " . $profile["lastnames"]; ?></title>
  <style>
    *
    {
      margin: 0;
      padding: 0;
      font-size: 12px;
      list-style: none;
      font-family: sans-serif;
    }

    h1 { font-size: 24px; }

    h2
    {
      margin-top: 25px;
      padding: 3px 5px;
      font-size: 18px;
      background-color: rgba(0, 0, 0, .2);
    }

    p.paratext { padding: 16px 0 0 12px; }

    li { padding: 4px 0; }

    table span
    {
      display: block;
      padding: 2px 0;
      color:rgba(0, 0, 0, .5);
      font-style: italic;
    }

    td { padding: 10px 0; }

    td:first-child
    {
      padding: 0 5px 0 0;
      text-align: center;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    .container
    {
      /* display: flex; */
    }

    .sideleft
    {
      background-color: rgba(0, 0, 0, .8);
      color: #fff;
      padding: 20px;
      width: 160px;
      float: left;
      height: 1082px;
    }

    .sideleft__img
    {
      width: 100%;
      border-radius: 50%;
    }

    .sideright
    {
      padding: 40px;
      width: 520px;
      float: right;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="sideleft">
      <!-- <img src="{{http://localhost/generatorCV/assets/img/620ee755d6ef1.png}}" class="sideleft__img"> -->
      <img src="<?php echo $profile["photo"]; ?>"  class="sideleft__img">
      <br><br>
      <h2 style="background-color: transparent;">CONTACT</h2>
      <br>
      <ul>
      <li><?php echo $profile["street"];?></li>
      <li><?php echo $profile["phone"];?></li>
      <li><?php echo $profile["email"];?></li>
      </ul>
    </div>
    <div class="sideright">
      <h1><?php echo $profile["name"] . " " . $profile["lastnames"]; ?></h1>
      <h2>RESUMEN</h2>
      <p class="paratext">
        <?php echo $ability['resume'];?>
      </p>
      <h2>WORK EXPERIENCE</h2>
      <table>
        <?php
        
        foreach($works as $row)
        {

          ?>

            <tr>
              <td><?php echo $row['start_year'] . '-' . $row['finish_year']; ?></td>
              <td>
                <h3><?php echo $row['company'];?></h3>
                <span><?php echo $row['position'];?></span>
                <p>
                  <?php echo $row['description'];?>
                </p>
              </td>
            </tr>

          <?php

        }
        
        ?>
      </table>
      <h2>EDUCATION</h2>
      <table>
        <?php 
        
        foreach($educations as $row)

        {

          ?>

            <tr>
              <td><?php echo $row['graduation_year']; ?></td>
              <td>
                <h3><?php echo $row['education_center']?></h3>
                <span><?php echo $row['speciality'];?></span>
                <p>
                  <?php echo $row['description'];?>
                </p>
              </td>
            </tr>

          <?php

        }

        ?>

      </table>
      <h2>APTITUDES</h2>
      <p class="paratext">
        <?php echo $ability['html_body'];?>
      </p>
    </div>
  </div>
</body>
</html>