<?php

namespace App\Livewire;

use App\Filament\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Concerns\InteractsWithHeaderActions;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class Users extends Component implements HasActions, HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;
    use InteractsWithActions;
    use InteractsWithHeaderActions;

    public User $user;

    public function mount(): void
    {
        $this->user = new User();
    }

    /**
     * @throws \Exception
     */
    public function table(Table $table): Table
    {
        return $table
            ->heading('Users')
            ->query(User::query())
            ->relationship(fn (): BelongsToMany => $this->user->roles())
            ->inverseRelationship('roles')
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('first_name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('last_name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('netid')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('uin')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('roles.name')->badge()->searchable(),
            ])
            ->searchable()
            ->filters([
//                Tables\Filters\TrashedFilter::make(),
                SelectFilter::make('roles')
                    ->relationship('roles', 'name')
                    ->options(Role::get()->pluck('name', 'name'))
            ])
            ->actions([
//                EditAction::make()
//                    ->form([
//                        TextInput::make('name')->required(),
//                        TextInput::make('first_name')->required(),
//                        TextInput::make('last_name')->required(),
//                        TextInput::make('netid')->required()->unique(),
//                        TextInput::make('email')->required()->unique()->email(),
//                        TextInput::make('uin')->required()->unique()->numeric()
//                    ])
//                    ->slideOver()
//                    ->action(function (User $user, array $data) {
//                        dd($data);
//                    }),
                Action::make('edit')
                    ->form([
                        TextInput::make('name')->required(),
                        TextInput::make('first_name')->required(),
                        TextInput::make('last_name')->required(),
                        TextInput::make('netid')->required()->unique(),
                        TextInput::make('email')->required()->unique()->email(),
                        TextInput::make('uin')->required()->unique()->numeric()
                    ]),
                Tables\Actions\DeleteAction::make()
                    ->requiresConfirmation()
                    ->action(fn (User $record) => $record->delete())
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->requiresConfirmation(),
                ]),
            ])->headerActions([
                Tables\Actions\CreateAction::make()
                    ->model(User::class)
                    ->slideOver()
                    ->form(fn(Form $form) => UserResource::form($form))
                    ->using(function (array $data, string $model): User {
                        $data['password'] = Hash::make('password');
                        return $model::create($data);
                    })
            ]);
    }

    public function render(): View
    {
        return view('livewire.users');
    }
}
