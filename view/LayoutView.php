<?php


class LayoutView {
  
  public function render($isLoggedIn, $view, DateTimeView $dtv) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 4</h1>
          ' . $this->renderIsLoggedIn($isLoggedIn) . '
          
          <div class="container">
              ' . $this->generateRegisterLinkHTML() . '
              ' . $view->response() . '    
              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }
  
  private function renderIsLoggedIn($isLoggedIn) {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }

  private function generateRegisterLinkHTML() {
    if(isset($_GET['register']))
    {
      return '<a href=?>GO BACK!</a>';
    }
    else
    return '<a href=?register>REGISTER NOW!</a>';
  }
}
