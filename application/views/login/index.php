<body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <?php echo form_open(base_url(), array('class' => 'm-t'));?>
              <h1>Cafetería KONECTA</h1>
              <div>
                <input type="text" class="form-control" name="login" placeholder="Usuario" required="" value="11223344"/>
              </div>
              <div>
                <input type="password" class="form-control" name="contrasena" placeholder="Contraseña" required="" value="11223344"/>
              </div>
              <div>
                <button type="submit" class="btn btn-default">Ingresar</button>
              </div>
              
              <p class="error"><?php echo $msg; ?></p>
              <?php if ($this->session->flashdata('msg')){ echo $this->session->flashdata('msg'); } ?>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />
                <div>
                  <h1><i class="fa fa-pencil-square-o"></i> Cafetería KONECTA</h1>
                  <p>©2022 All Rights Reserved. Privacy and Terms. <br>Tienda POS <i class="fa fa-heart"></i> Roy Roa</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>