<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class ShowResetPasswordLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'password:show-reset-link {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tampilkan reset password link untuk testing (Development only)';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $email = $this->argument('email');

        // Check if user exists
        $user = User::where('email', $email)->first();
        if (!$user) {
            $this->error("❌ User dengan email '$email' tidak ditemukan!");
            return 1;
        }

        // Get reset token dari database
        $resetToken = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$resetToken) {
            $this->error("❌ Tidak ada reset token untuk email '$email'. Silakan request reset password terlebih dahulu!");
            return 1;
        }

        // Generate reset link
        $resetLink = URL::route('password.reset', ['token' => $resetToken->token]);

        // Display info
        $this->info("✅ Reset Password Link Found!");
        $this->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
        $this->line("Email: <fg=cyan>$email</>");
        $this->line("Token: <fg=yellow>{$resetToken->token}</>");
        $this->line("");
        $this->line("Reset Link:");
        $this->line("<fg=green>$resetLink</>");
        $this->line("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
        $this->info("");
        $this->warn("📝 Catatan:");
        $this->warn("• Link ini berlaku selama 60 menit");
        $this->warn("• Copy link di atas dan buka di browser");
        $this->warn("• Atau gunakan command: php artisan password:show-reset-link <email>");

        return 0;
    }
}
