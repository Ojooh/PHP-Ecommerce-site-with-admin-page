<!-- profile -->
<div id="profile" class="tab-pane">
  <section class="panel">
    <div class="bio-graph-heading">
      Hello I’m <?= $user_data['full_name']; ?>, a leading expert in interactive and creative web design specializing  as a/an <?= $user_data['Occupation']; ?>.
    </div>
    <div class="panel-body bio-graph-info">
      <h1>Bio Graph</h1>
      <div class="row">
        <div class="bio-row">
          <p><span>First Name </span>: <?= $user_data['first']; ?> </p>
        </div>
        <div class="bio-row">
          <p><span>Last Name </span>: <?= $user_data['last']; ?></p>
        </div>
        <div class="bio-row">
          <p><span>Country </span>: Nigeria</p>
        </div>
        <div class="bio-row">
          <p><span>Occupation </span>: <?= $user_data['Occupation']; ?></p>
        </div>
        <div class="bio-row">
          <p><span>Email </span>: <?= $user_data['email']; ?></p>
        </div>
        <div class="bio-row">
          <p><span>Mobile </span>: <?= $user_data['number']; ?></p>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="row">
    </div>
  </section>
</div>
